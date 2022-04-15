<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFriendsController extends Controller
{
    function get(int $id)
    {
        dump($id);
        return view('friends');
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
