@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h3 my-4">Znajomi</div>
        <add-friend
            :users="{{ json_encode($users) }}"
            :friends="{{ json_encode($friends) }}"
            :invitations=" {{ json_encode($invitations) }}"
            :invited="{{ json_encode($invited) }}"
        ></add-friend>
        @if($friends === [])
            <h1 class="text-center" style="padding: 100px">Brak znajomych</h1>
        @endif
        <friends :friends="{{ json_encode($friends)}}"></friends>
    </div>
@endsection
