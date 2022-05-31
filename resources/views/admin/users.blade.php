@extends('layouts.app')

@section('content')
    <div class="container">
        <users-list :users="{{ json_encode($users) }}"></users-list>
    </div>
@endsection
