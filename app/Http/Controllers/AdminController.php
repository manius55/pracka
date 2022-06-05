<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{

    /**
     * @OA\Get(
     *     path="/admin/users",
     *     summary="Lista użytkowników",
     *     description="Widok listy użytkowników",
     *           @OA\Response (
     *     response=200,
     *     description="Pobrano listę użytkowników",
     * )
     * )
     */
    public function usersList()
    {
        $users = User::all()->toArray();

        $usersWithImage = DB::table('users')
            ->join('user_profiles', 'users.id','=','user_profiles.user_id')
            ->select('users.name', 'users.id', 'user_profiles.image', 'users.email')->get();

        return Response::view('admin.users', [
            'users' => $usersWithImage
        ]);
    }

    /**
     * @OA\Get(
     *     path="/admin/channels",
     *     summary="Lista kanałów",
     *     description="Widok listy kanałów",
     *           @OA\Response (
     *     response=200,
     *     description="Pobrano listę kanałów"
     * )
     * )
     */
    public function channelsList()
    {
        $channels = Channels::all()->toArray();

        return Response::view('admin.channels', [
            'channels' => $channels
        ]);
    }

    /**
     * @OA\Get(
     *     path="/admin/channelsAdmins",
     *     summary="Lista kanałów i administratorów",
     *     description="Widok listy kanałów wraz z administratorami",
     *           @OA\Response (
     *     response=200,
     *     description="Pobrano listę kanałów i ich administratorów"
     * )
     * )
     */
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

        return Response::view('admin.channelsAdmins', [
            'channels' => $channelsWithAdmins
        ]);
    }
}
