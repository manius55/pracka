<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserFriendsController extends Controller
{
    function get(int $id)
    {
        $friends = Friends::where('user_id', '=', $id)->get();
        $friendsIds = [];
        foreach ($friends as $friend)
        {
            array_push($friendsIds, ($friend->attributesToArray()['friend_id']));
        }

        $friendsUsers = DB::table('users')->whereIn('id', $friendsIds)->get();
        return view('friends', [
            'friends' => $friendsUsers
        ]);
    }

    function create(int $id)
    {
        Friends::create([
            'user_id' => Auth::id(),
            'friend_id' => $id
        ]);
        Friends::create([
            'user_id' => $id,
            'friend_id' => Auth::id()
        ]);
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

    }

    function update(int $if, int $userId)
    {

    }
}
