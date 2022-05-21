<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class UserFriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function get(int $id)
    {
        $friends = Friends::where('user_id', '=', $id)->get();
        $friendsIds = [];
        foreach ($friends as $friend)
        {
            array_push($friendsIds, ($friend->attributesToArray()['friend_id']));
        }

        $friendsUsers = DB::table('users')->whereIn('id', $friendsIds)->get()->toArray();
        $users = DB::table('users')->get()->toArray();

        $invitations = DB::table('invitations')->where([
            ['to_user', '=', Auth::id()],
            ['accepted', '=', false]
        ])->pluck('from_user')->toArray();

        $invited = DB::table('invitations')->where([
            ['from_user', '=', Auth::id()],
            ['accepted', '=', false]
        ])->pluck('to_user')->toArray();


        return Response::view('friends', [
            'friends' => $friendsUsers,
            'users' => $users,
            'invitations' => $invitations,
            'invited' => $invited
        ], 200);
    }

    function create(int $id)
    {
        $friend = Friends::create([
            'user_id' => Auth::id(),
            'friend_id' => $id
        ]);
        Friends::create([
            'user_id' => $id,
            'friend_id' => Auth::id()
        ]);

        return Response::json($friend, 201);
    }

    function delete(int $id)
    {
        DB::table('friends')->where([
            ['user_id', '=', Auth::id()],
            ['friend_id', '=', $id]
        ])->delete();

        DB::table('friends')->where([
            ['user_id', '=', $id],
            ['friend_id', '=', Auth::id()]
        ])->delete();

         DB::table('invitations')->where([
            ['from_user', '=' , $id],
            ['to_user', '=', Auth::id()]
        ])->delete();

        DB::table('invitations')->where([
            ['from_user', '=' , Auth::id()],
            ['to_user', '=', $id]
        ])->delete();

         return Response::json(null, 204);
    }

    function update(int $if, int $userId)
    {

    }
}
