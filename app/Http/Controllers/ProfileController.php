<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg'
            ]);
            $name = $request->file('image')->getClientOriginalName();
            $nameAndExt = explode('.', $name);
            $ext = end($nameAndExt);
            $uId = uniqid();
            $request->file('image')->move(public_path('storage/img'), $uId . '.' . $ext);

            if(File::exists(public_path('storage/img' . $profile->image)) && $profile->image !== 'default.png')
                File::delete(public_path('storage/img' . $profile->image));

            $profile->image = $uId . '.' . $ext;
        }

        $profile->description = $data['description'];
        $profile->date_of_birth = $data['date_of_birth'];
        $profile->save();

        return redirect('/profile/' . $id);
    }
}
