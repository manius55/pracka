<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function usersList()
    {
        $users = User::all()->toArray();

        $usersWithImage = DB::table('users')
            ->join('user_profiles', 'users.id','=','user_profiles.user_id')
            ->select('users.name', 'users.id', 'user_profiles.image', 'users.email')->get();

        return view('admin.users', [
            'users' => $usersWithImage
        ]);
    }

    public function channelsList()
    {
        $channels = Channels::all()->toArray();

        return view('admin.channels', [
            'channels' => $channels
        ]);
    }

    public function channelsAdmins()
    {
        $channelsWithAdmins = DB::table('channels')
            ->join('channel_admins', 'channels.id', '=', 'channel_admins.channel_id')
            ->select('channels.channel_name', 'channels.id', 'channels.image', 'channel_admins.owner', 'channel_admins.user_id')->get()->toArray();
        foreach ($channelsWithAdmins as $channel)
        {
            $channel->user_name = DB::table('users')->where('id', '=', $channel->user_id)->value('name');
            $channel->owner = $channel->owner === 1 ? 'tak' : 'nie';
        }

        return view('admin.channelsAdmins', [
            'channels' => $channelsWithAdmins
        ]);
    }
}
