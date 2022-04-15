<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\User;
use Illuminate\Http\Request;
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

    }

    function delete(int $id, int $userId)
    {

    }

    function update(int $if, int $userId)
    {

    }
}
