@extends('layouts.app')

@section('content')
    <profile-description :profile=" {{ $profile }}"></profile-description>
@endsection
