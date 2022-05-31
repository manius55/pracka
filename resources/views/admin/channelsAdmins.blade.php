@extends('layouts.app')

@section('content')
    <div class="container">
        <channels-admins-list :channels="{{ json_encode($channels) }}"></channels-admins-list>
    </div>
@endsection
