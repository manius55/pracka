@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                <div class="justify-content-start">
                        <a class="btn btn-success my-1" href="/channel/createForm">Stwórz kanał</a>
                    @if($channels!==[] && isset($admin) && ((isset($id) && in_array($id, $admin)) || in_array($channels[0]->id, $admin)))
                        <button class="btn-primary btn"> Zarządzaj kanałem</button>
                    @endif
                </div>
                @if($channels !== [])
                <div class="col-3">
                    <channels :channels="{{ json_encode($channels) }}" :id="{{ json_encode($id ?? $channels[0]->id) }}"></channels>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">Kanał tekstowy</div>
                        <div class="card-body">
                            <messages :messages="messages" :id="{{ \Illuminate\Support\Facades\Auth::id() }}" :channel="{{ json_encode($id ?? $channels[0]->id) }}"></messages>
                        </div>
                        <div class="card-footer">
                            <new-message v-on:messagesent="newMessage" :user="{{ json_encode($user) }}" :channel_id="{{ json_encode($id ?? $channels[0]->id) }}"></new-message>
                        </div>
                    </div>
                </div>
                @else
                    <div class="h1">Brak kanałów</div>
                @endif
            </div>
        </div>
@endsection
