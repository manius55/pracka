<?php

namespace App\Http\Controllers;

use App\Mail\ChannelEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Facades\Response;

class MailController extends Controller
{
    public function sendEmail(int $id)
    {
        $channel = DB::table('channels')->find($id);
        $channelName = $channel->channel_name;

        $usersId = DB::table('user_channels')->where('channel_id', '=', $id)->pluck('user_id');
        $users = DB::table('users')->whereIn('id', $usersId)->get();
        foreach ($users as $user)
        {
            Mail::to($user->email)->send(new ChannelEmail($channelName, $user->name));
        }

        return Response::redirectTo('/channel/' . $id);
    }
}
