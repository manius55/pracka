@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="h3 my-4">Invitations</div>
    <invitations-list :users="{{ json_encode($users) }}"></invitations-list>
    </div>
@endsection
