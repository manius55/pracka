<?php

namespace App\Http\Controllers;

use App\Models\ChannelAdmin;
use App\Models\ChannelMessages;
use App\Models\Channels;
use App\Models\User;
use App\Models\UserChannels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @OA\Get(
     *     path="/channel",
     *     summary="Domyślny kanał",
     *     description="Widok domyślnego kanału",
     *           @OA\Response (
     *     response=200,
     *     description="Otworzono widok kanału"
     * )
     * )
     */
    public function index()
    {
        $userChannels = DB::table('user_channels')->where('user_id', '=', Auth::id())->pluck('channel_id')->toArray();
        $channels = DB::table('channels')->whereIn('id', $userChannels)->get()->toArray();
        $user = User::where('id', '=', Auth::id())->first()->toArray();
        $image = DB::table('user_profiles')->where('user_id', '=', Auth::id())->first();
        $user['image'] = $image->image ?? 'default.png';
        $admin = ChannelAdmin::where('user_id', '=', Auth::id())->pluck('channel_id')->toArray();

        return Response::view('channels.channel',[
            'channels' => $channels,
            'user' => $user,
            'admin' => $admin
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/channel/createForm",
     *     summary="Widok formularza kanału",
     *     description="Widok formularza tworzenia kanału",
     *           @OA\Response (
     *     response=200,
     *     description="Otworzono widok tworzenia kanału"
     * )
     * )
     */
    public function createChannelForm()
    {
        return Response::view('channels.createChannelForm');
    }

    /**
     * @OA\Get(
     *     path="/channel/{id}",
     *     summary="Konkretny kanał",
     *     description="Widok konkretnego kanału",
     *     @OA\Parameter (
     *     description="Id kanału",
     *     in="path",
     *     name="id",
     *     required=true,
     *     example="7",
     *     ),
     *           @OA\Response (
     *     response=200,
     *     description="Otworzono widok kanału"
     * )
     * )
     */
    public function getChannel(int $id)
    {
        $userChannels = DB::table('user_channels')->where('user_id', '=', Auth::id())->pluck('channel_id')->toArray();
        $channels = DB::table('channels')->whereIn('id', $userChannels)->get()->toArray();

        $user = User::where('id', '=', Auth::id())->first()->toArray();
        $image = DB::table('user_profiles')->where('user_id', '=', Auth::id())->first();
        $user['image'] = $image->image ?? 'default.png';
        $admin = ChannelAdmin::where('user_id', '=', Auth::id())->pluck('channel_id')->toArray();

        return Response::view('channels.channel',[
            'channels' => $channels,
            'user' => $user,
            'id' => $id,
            'admin' => $admin
        ], 200);
    }


    public function getChannelUsers(int $id)
    {
        $users = User::all()->toArray();
        $channelsUsers = DB::table('user_channels')->where('channel_id', '=', $id)->pluck('user_id')->toArray();
        $channelUsersWithImage = DB::table('users')
            ->join('user_profiles', 'users.id','=','user_profiles.user_id')
            ->whereIn('users.id', $channelsUsers)
            ->select('users.name', 'users.id', 'user_profiles.image')->get();
        foreach ($channelUsersWithImage as $user)
        {
            $userIsAdmin = (DB::table('channel_admins')->where('user_id', '=', $user->id)->where('channel_id', '=', $id)->first()) ?? null;

            if ($userIsAdmin !== null)
            {
                $user->admin = true;
                if ($userIsAdmin->owner === 1)
                    $user->owner = true;
                else
                    $user->owner = false;
            }
            else
            {
                $user->admin = false;
                $user->owner = false;
            }
        }

        $friendsIds = DB::table('friends')->where('user_id', '=', Auth::id())->pluck('friend_id')->toArray();
        $friends = DB::table('users')->whereIn('id', $friendsIds)->get()->toArray();
        $owner = ChannelAdmin::where([
            ['user_id', '=', Auth::id()],
            ['owner', '=', true]
        ])->pluck('channel_id')->toArray();

        return Response::view('channels.channelUsersList', [
            'users' => $users,
            'channels_users' => $channelsUsers,
            'id' => $id,
            'friends' => $friends,
            'owner' => $owner,
            'channel_users_with_image' => $channelUsersWithImage
        ], 200);
    }

    public function newMessage(Request $request)
    {
        $data = $request->request->all();

        $createdMessage = ChannelMessages::create([
            'from_user_id' => Auth::id(),
            'channel_id' => $data['channel_id'],
            'message' => $data['message']
        ]);
        $user = User::where('id', '=', Auth::id())->first()->toArray();
        $image = DB::table('user_profiles')->where('user_id', '=', Auth::id())->first();
        $user['image'] = $image->image ?? 'default.png';

        broadcast(new MessageSent($user, $createdMessage))->toOthers();

        return Response::json($createdMessage, 201);
    }

    public function messagesWithUser()
    {
        $messageWithUser = ChannelMessages::with('user')->orderBy('created_at', 'desc')->get()->toArray();
        $messageWithUserAndImage = [];
        foreach ($messageWithUser as $object) {
            $user = $object['user'];
            $image = DB::table('user_profiles')->where('user_id', '=', $user['id'])->first();
            $image = $image->image ?? 'default';
            $user['image'] = $image;
            $object['user'] = $user;
            array_push($messageWithUserAndImage, $object);
        }

        return Response::json($messageWithUserAndImage, 200);
    }

    public function createChannel(Request $request)
    {
        $data = $request->request->all();
        if ($data['channel_name'] === null && !($request->hasFile('image')))
        {
            return Response::redirectTo('/channel', 400);
        }

        if($request->hasFile('image'))
        {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg'
            ], [
                'image' => 'Ten plik musi być obrazkiem',
                'required' => 'To pole jest wymagane'
            ]);
            $path = $request->file('image')->store('images', 's3');
            $name = substr($path,  strpos($path, '/')+1);

            $channel = Channels::create([
                'channel_name' => $data['channel_name'],
                'image' => $name
            ]);
        }
        else {
            $channel = Channels::create([
                'channel_name' => $data['channel_name'],
                'image' => 'default.png'
            ]);
        }


        $userChannel = UserChannels::create([
           'user_id' => Auth::id(),
           'channel_id' => $channel->id
        ]);

        $channelAdmin = ChannelAdmin::create([
            'user_id' => Auth::id(),
            'channel_id' => $channel->id,
            'owner' => true
        ]);

        return Response::redirectTo('/channel', 201);
    }

    public function addUser(int $channelId, int $userId)
    {
        $newUser = UserChannels::create([
           'channel_id' => $channelId,
            'user_id' =>$userId
        ]);

        return Response::json($newUser, 201);
    }

    public function editChannelForm(int $id)
    {
        $channel = DB::table('channels')->find($id);
        return Response::view('channels.editChannelForm', [
            'channel' => $channel
        ], 200);
    }

    public function editChannel(Request $request, int $id)
    {
        $data = $request->request->all();

        $channel = Channels::find($id);

        if($request->hasFile('image'))
        {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg',
                'channel_name' => 'required|string'
            ],[
                'image' => 'Ten plik musi być obrazkiem',
                'required' => 'To pole jest wymagane',
                'string' => 'To pole musi być typu string'
            ]);
            $path = $request->file('image')->store('images', 's3');
            $name = substr($path,  strpos($path, '/')+1);

            if(Storage::disk('s3')->exists('images/' . $channel->image) && $channel->image !== 'images/default.png')
                Storage::disk('s3')->delete('images/' . $channel->image);

            $channel->image = $name;
        }

        $channel->channel_name = $data['channel_name'];
        $channel->save();

        return Response::redirectTo('/channel', 302);
    }

    public function editAdminStatus(int $channelId, int $userId)
    {
        if (ChannelAdmin::where('channel_id', '=', $channelId)->where('user_id', '=', $userId)->get()->toArray() !== [])
            ChannelAdmin::where('channel_id', '=', $channelId)->where('user_id', '=', $userId)->delete();
        else
            ChannelAdmin::create(['channel_id' => $channelId,'user_id' => $userId, 'owner' => false]);

        return Response::json([], 200);
    }

    public function deleteChannel(int $id)
    {
        $channelAdmins = DB::table('channel_admins')->where('channel_id', '=', $id)->delete();
        $userChannels = DB::table('user_channels')->where('channel_id', '=', $id)->delete();
        $channelMessages = DB::table('channel_messages')->where('channel_id', '=', $id)->delete();
        $channel = DB::table('channels')->where('id', '=', $id)->delete();

        return Response::json(null, 204);
    }

    public function deleteUserFromChannel(int $channelId, int $userId)
    {
        if (ChannelAdmin::where('channel_id', '=', $channelId)->where('user_id', '=', $userId)->get()->toArray() !== [])
            ChannelAdmin::where('channel_id', '=', $channelId)->where('user_id', '=', $userId)->delete();
        UserChannels::where('user_id', '=', $userId)->where('channel_id', '=', $channelId)->delete();

        return Response::json(null, 204);
    }
}
