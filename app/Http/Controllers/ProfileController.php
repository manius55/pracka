<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    function get(int $id)
    {
        $profile = DB::table('user_profiles')->where('user_id', '=', $id)->first();
        $user = DB::table('users')->where('id', '=', $id)->first();

        $friends = Friends::where('user_id', '=', Auth::id())->get();
        $friendsIds = [];
        foreach ($friends as $friend)
        {
            array_push($friendsIds, ($friend->attributesToArray()['friend_id']));
        }

        $friendsUsers = DB::table('users')->whereIn('id', $friendsIds)->get();

        $invitations = DB::table('invitations')->where([
            ['to_user', '=', Auth::id()],
            ['accepted', '=', false]
        ])->pluck('from_user')->toArray();

        $invited = DB::table('invitations')->where([
            ['from_user', '=', Auth::id()],
            ['accepted', '=', false]
        ])->pluck('to_user')->toArray();
        return Response::view('profile.profile', [
            'profile' => $profile,
            'user' => $user,
            'friends' => $friendsUsers,
            'invitations' => $invitations,
            'invited' => $invited
        ], 200);
    }

    function editForm(int $id)
    {
        $profile = DB::table('user_profiles')->where('user_id', '=', $id)->first();
        return Response::view('profile.editForm', [
            'profile' => $profile
        ], 200);
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
            $path = $request->file('image')->store('images', 's3');
            $name = substr($path,  strpos($path, '/')+1);

            if(Storage::disk('s3')->exists('images/' . $profile->image) && $profile->image !== 'images/default.png')
                Storage::disk('s3')->delete('images/' . $profile->image);

            $profile->image = $name;
        }

        $profile->description = $data['description'];
        $profile->date_of_birth = $data['date_of_birth'];
        $profile->save();

        return Response::redirectTo('/profile/' . $id, 302);
    }
}
