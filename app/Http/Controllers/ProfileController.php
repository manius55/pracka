<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    function get(int $id)
    {
        $profile = DB::table('user_profiles')->where('user_id', '=', $id)->first();

        return view('profile.profile', [
            'profile' => $profile
        ]);
    }

    function editForm(int $id)
    {
        $profile = DB::table('user_profiles')->where('user_id', '=', $id)->first();
        return view('profile.editForm', [
            'profile' => $profile
        ]);
    }

    function edit(int $id, Request $request)
    {
        $data = $request->request->all();

        $uId = uniqid();

        $name = $request->file('image')->getClientOriginalName();
        $nameAndExt = explode('.', $name);
        $ext = end($nameAndExt);
        $file = $request->file('image')->move('/home/manius55/projects/PracaInzynierska/chat-app/resources/avatars', $uId . '.' . $ext);

        $profile = UserProfile::where('user_id', '=', $id)->first();


        $profile->description = $data['description'];
        $profile->date_of_birth = $data['date_of_birth'];
        $profile->image = $uId;
        $profile->save();
    }
}
