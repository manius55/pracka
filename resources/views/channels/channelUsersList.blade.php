@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            @if(isset($owner) && in_array($id, $owner))
            <delete-channel :id="{{ json_encode($id) }}"></delete-channel>
            @endif
            <add-user :users="{{ json_encode($users) }}" :channel_users="{{ json_encode($channels_users) }}" :id="{{ json_encode($id) }}" :friends="{{ json_encode($friends) }}"></add-user>
        </div>
        <channel-users :users="{{ json_encode($channel_users_with_image) }}" :id="{{ json_encode(\Illuminate\Support\Facades\Auth::id()) }}"></channel-users>
    </div>
@endsection
