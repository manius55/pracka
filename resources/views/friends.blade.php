@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h3 my-4">Friends</div>
        <add-friend :users="{{ json_encode($users) }}"></add-friend>
        <friends :friends="{{ json_encode($friends)}}"></friends>
    </div>
@endsection
