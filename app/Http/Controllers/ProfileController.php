<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
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

        $profile = UserProfile::where('user_id', '=', $id)->first();

        if($request->hasFile('image'))
        {
            $name = $request->file('image')->getClientOriginalName();
            $nameAndExt = explode('.', $name);
            $ext = end($nameAndExt);
            $uId = uniqid();
            $file = $request->file('image')->move('/home/manius55/projects/PracaInzynierska/chat-app/resources/avatars', $uId . '.' . $ext);
            $profile->image = $uId;
        }

        $profile->description = $data['description'];
        $profile->date_of_birth = $data['date_of_birth'];
        $profile->save();

        return redirect('/profile/' . $id);
    }
}
