<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    function get()
    {
        $profile = DB::table('user_profiles')->find(3);
        dump($profile);
//        $abc = (array) $profile;
//        $abcDate = $abc['date_of_birth'];
        return view('profile', [
            'profile' => $profile
        ]);
    }

    function update(array $data)
    {

    }
}
