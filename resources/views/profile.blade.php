@extends('layouts.app')

@section('content')
    <profile-description :profile=" {{ json_encode($profile) }}"></profile-description>
@endsection
