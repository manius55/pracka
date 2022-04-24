@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h3 my-4">Wysłane zaproszenia</div>
        <my-invitations-list :users="{{ json_encode($users) }}"></my-invitations-list>
    </div>
@endsection
