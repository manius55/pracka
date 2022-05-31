@extends('layouts.app')

@section('content')
    <div class="container">
        <channels-list :channels="{{ json_encode($channels) }}"></channels-list>
    </div>
@endsection
