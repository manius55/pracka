@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-end">
            <add-user :users="{{ json_encode($users) }}" :channel_users="{{ json_encode($channels_users) }}" :id="{{ json_encode($id) }}"></add-user>
        </div>
    </div>
@endsection
