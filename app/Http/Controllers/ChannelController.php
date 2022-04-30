<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('channels.channel');
    }
    public function newMessage(Request $request)
    {
        $data = $request->request->all();
    }
}
