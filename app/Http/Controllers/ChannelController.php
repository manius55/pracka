<?php

namespace App\Http\Controllers;

use App\Models\ChannelAdmin;
use App\Models\ChannelMessages;
use App\Models\Channels;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $userChannels = DB::table('user_channels')->where('user_id', '=', Auth::id())->pluck('channel_id')->toArray();
        $channels = DB::table('channels')->whereIn('id', $userChannels)->get()->toArray();

        $user = User::where('id', '=', Auth::id())->first()->toArray();
        $image = DB::table('user_profiles')->where('user_id', '=', Auth::id())->first();
        $user['image'] = $image->image;

        return view('channels.channel',[
            'channels' => $channels,
            'user' => $user
        ]);
    }

    public function createChannelForm()
    {
        return view('channels.createChannelForm');
    }

    public function getChannel(int $id)
    {
        $userChannels = DB::table('user_channels')->where('user_id', '=', Auth::id())->pluck('channel_id')->toArray();
        $channels = DB::table('channels')->whereIn('id', $userChannels)->get();

        $user = User::where('id', '=', Auth::id())->first()->toArray();
        $image = DB::table('user_profiles')->where('user_id', '=', Auth::id())->first();
        $user['image'] = $image->image;

        return view('channels.channel',[
            'channels' => $channels,
            'user' => $user,
            'id' => $id
        ]);
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
        $user['image'] = $image->image;

        broadcast(new MessageSent($user, $createdMessage))->toOthers();
    }

    public function messagesWithUser()
    {
        $messageWithUser = ChannelMessages::with('user')->get()->toArray();
        $messageWithUserAndImage = [];
        foreach ($messageWithUser as $object) {
            $user = $object['user'];
            $image = DB::table('user_profiles')->where('user_id', '=', $user['id'])->first();
            $image = $image->image;
            $user['image'] = $image;
            $object['user'] = $user;
            array_push($messageWithUserAndImage, $object);
        }

        return $messageWithUserAndImage;
    }

    public function createChannel(Request $request)
    {
        $data = $request->request->all();
        $channel = Channels::create([
            'channel_name' => $data['channel_name']
        ]);
        $channelAdmin = ChannelAdmin::create([
            'user_id' => Auth::id(),
            'channel_id' => $channel->id,
            'owner' => true
        ]);
    }

    public function editChannel(Request $request, int $id)
    {
        $data = $request->request->all();

        $channel = DB::table('channels')->find($id);

        if($request->hasFile('image'))
        {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg'
            ]);
            $name = $request->file('image')->getClientOriginalName();
            $nameAndExt = explode('.', $name);
            $ext = end($nameAndExt);
            $uId = uniqid();
            $request->file('image')->move(public_path('storage/img'), $uId . '.' . $ext);

            if(File::exists(public_path('storage/img' . $channel->image)) && $channel->image !== 'default.png')
                File::delete(public_path('storage/img' . $channel->image));

            $channel->image = $uId . '.' . $ext;
        }

        $channel->channel_name = $data['channel_name'];
        $channel->save();
    }

    public function deleteChannel(int $id)
    {
        $channel = DB::table('channels')->find($id);

        $channel->delete();
    }
}
