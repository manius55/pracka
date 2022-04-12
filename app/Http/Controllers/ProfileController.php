<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    function get(int $id)
    {
        $profile = DB::table('user_profiles')->where('user_id', '=', $id)->first();

        return view('profile.profile', [
            'profile' => $profile
        ]);
    }

    function editForm()
    {
        return view('profile.editForm');
    }
}
