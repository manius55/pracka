@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h3 my-4">Wysłane zaproszenia</div>
        @if($users === [])
            <h1 class="text-center" style="padding: 100px">Brak wysłanych zaproszeń</h1>
        @endif
        <my-invitations-list :users="{{ json_encode($users) }}"></my-invitations-list>
    </div>
@endsection
