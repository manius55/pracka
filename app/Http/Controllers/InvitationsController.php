<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvitationsController extends Controller
{
    public function sendIvitation(string $name)
    {
        $user = DB::table('users')->where('name', '=', $name);
        dd($user);
    }

    public function getInvitations()
    {
        $invitationsId = DB::table('invitations')->where('to_user', '=', Auth::id())->pluck('from_user')->toArray();
        $invitationsUsers = DB::table('users')->whereIn('id', $invitationsId)->get();

        return view('invitations', [
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

    public function accept(int $id)
    {
        $invitation = DB::table('invitations')->where([
            ['from_user', '=' , $id],
            ['to_user', '=', Auth::id()]
        ])->first();

        $invitation->accepted = true;
        $invitation->save();
    }
}
