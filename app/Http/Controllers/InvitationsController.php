<?php

namespace App\Http\Controllers;

use App\Models\Invitations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class InvitationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function sendInvitation(string $name)
    {
        $user = DB::table('users')->where('name', '=', $name)->first();
        if (DB::table('friends')->where('friend_id', '=', $user->id)->doesntExist())
        {
            $invitation = Invitations::create([
                'from_user' => Auth::id(),
                'to_user' => $user->id,
                'accepted' => false,
            ]);
        }

        return Response::json($invitation, 201);
    }

    public function getInvitations()
    {
        $invitationsId = DB::table('invitations')->where([
            ['to_user', '=', Auth::id()],
            ['accepted', '=', false]
        ])->pluck('from_user')->toArray();

        $invitationsUsers = DB::table('users')->whereIn('id', $invitationsId)->get()->toArray();

        return Response::view('invitations', [
            'users' => $invitationsUsers
        ], 200);
    }

    public function getMyInvitations()
    {
        $invitationsId = DB::table('invitations')->where([
            ['from_user', '=', Auth::id()],
            ['accepted', '=', false]
        ])->pluck('to_user')->toArray();

        $invitationsUsers = DB::table('users')->whereIn('id', $invitationsId)->get()->toArray();

        return Response::view('myInvitations', [
            'users' => $invitationsUsers
        ], 200);
    }

    public function delete(int $id)
    {
        $invitation = DB::table('invitations')->where([
           ['from_user', '=' , $id],
           ['to_user', '=', Auth::id()]
        ])->delete();

        return Response::json(null, 204);
    }

    public function deleteMyInvitation(int $id)
    {
        $invitation = DB::table('invitations')->where([
            ['from_user', '=' , Auth::id()],
            ['to_user', '=', $id]
        ])->delete();

        return Response::json(null, 204);
    }

    public function update(int $id)
    {
        $invitation = DB::table('invitations')->where([
            ['from_user', '=' , $id],
            ['to_user', '=', Auth::id()]
        ])->update([
            'accepted' => true
        ]);

        return Response::json($invitation, 200);
    }
}
