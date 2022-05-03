@extends('layouts.app')

@section('content')
    <div class="container border">
        <div class="col-md gy-5">
            <div class="row justify-content-end">
                <div class="col-2">
                    <a class="btn btn-primary" href= {{ url('/profile/' . $profile->user_id . '/edit/form') }}>Edytuj profil</a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    @if($profile->image !== null)
                    <img
                        src="{{asset('storage/img/' . $profile->image)}}"
                        alt="avatar"
                        class="rounded-circle mx-auto d-flex"
                        style="width: 100px; height: 100px"
                    >
                    @else
                        <img
                            src="{{asset('storage/img/default.png')}}"
                            alt="avatar"
                            class="rounded-circle mx-auto d-flex"
                            style="width: 100px; height: 100px"
                        >
                    @endif
                </div>
            </div>
            @if($profile->description !== null)
            <div class="row justify-content-center py-2">
                <label for="description" class="text-center"><strong>Description:</strong></label>
                <div id="description" class="border col-6 border border-dark rounded" style="height: 75px"> <strong>{{$profile->description}} </strong> </div>
            </div>
            @endif
            @if($profile->date_of_birth !== null)
            <div class="row justify-content-center">
                <label for="date_of_birth" class="text-center"><strong>Date of birth</strong></label>
                <div id="date_of_birth" class="col-2 py-2 border text-center border-dark rounded">{{$profile->date_of_birth}}</div>
            </div>
            @endif
        </div>
    </div>
@endsection
