@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h3 my-4">Friends</div>
        <add-friend
            :users="{{ json_encode($users) }}"
            :friends="{{ json_encode($friends) }}"
            :invitations=" {{ json_encode($invitations) }}"
            :invited="{{ json_encode($invited) }}"
        ></add-friend>
        <friends :friends="{{ json_encode($friends)}}"></friends>
    </div>
@endsection
