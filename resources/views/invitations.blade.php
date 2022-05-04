@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="h3 my-4">Zaproszenia do znajomych</div>
        @if($users === [])
            <h1 class="text-center" style="padding: 100px">Brak otrzymanych zaproszeń</h1>
        @endif
    <invitations-list :users="{{ json_encode($users) }}"></invitations-list>
    </div>
@endsection
