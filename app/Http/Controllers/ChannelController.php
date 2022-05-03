<?php

namespace App\Http\Controllers;

use App\Models\ChannelMessages;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\DB;

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
}
