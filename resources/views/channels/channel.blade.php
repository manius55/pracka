@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <channels :channels="{{ json_encode($channels) }}"></channels>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">Channel</div>
                        <div class="card-body">
                            <messages :messages="messages" :id="{{ \Illuminate\Support\Facades\Auth::id() }}"></messages>
                        </div>
                        <div class="card-footer">
                            <new-message v-on:messagesent="newMessage" :user="{{ json_encode($user) }}"></new-message>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
