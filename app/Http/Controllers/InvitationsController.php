<?php

namespace App\Http\Controllers;

use App\Models\Invitations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvitationsController extends Controller
{
    public function sendInvitation(string $name)
    {
        $user = DB::table('users')->where('name', '=', $name)->first();
        if (DB::table('friends')->where('friend_id', '=', $user->id)->doesntExist())
        {
            Invitations::create([
                'from_user' => Auth::id(),
                'to_user' => $user->id,
                'accepted' => false,
            ]);
        }
    }

    public function getInvitations()
    {
        $invitationsId = DB::table('invitations')->where([
            ['to_user', '=', Auth::id()],
            ['accepted', '=', false]
        ])->pluck('from_user')->toArray();

        $invitationsUsers = DB::table('users')->whereIn('id', $invitationsId)->get();

        return view('invitations', [
            'users' => $invitationsUsers
        ]);
    }

    public function getMyInvitations()
    {
        $invitationsId = DB::table('invitations')->where([
            ['from_user', '=', Auth::id()],
            ['accepted', '=', false]
        ])->pluck('to_user')->toArray();

        $invitationsUsers = DB::table('users')->whereIn('id', $invitationsId)->get();

        return view('myInvitations', [
            'users' => $invitationsUsers
        ]);
    }

    public function delete(int $id)
    {
        $invitation = DB::table('invitations')->where([
           ['from_user', '=' , $id],
           ['to_user', '=', Auth::id()]
        ])->delete();
    }

    public function deleteMyInvitation(int $id)
    {
        $invitation = DB::table('invitations')->where([
            ['from_user', '=' , Auth::id()],
            ['to_user', '=', $id]
        ])->delete();
    }

    public function update(int $id)
    {
        $invitation = DB::table('invitations')->where([
            ['from_user', '=' , $id],
            ['to_user', '=', Auth::id()]
        ])->update([
            'accepted' => true
        ]);
        dump($invitation);
    }
}
