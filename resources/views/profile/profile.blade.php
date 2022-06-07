@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md gy-5">
            <div class="row justify-content-end">
                @if($profile->user_id === \Illuminate\Support\Facades\Auth::id())
                <div class="col-2">
                    <a class="btn btn-primary" href= {{ url('/profile/' . $profile->user_id . '/edit/form') }}>Edytuj profil</a>
                </div>
                @else
                    <add-specificfriend
                        :friends="{{ json_encode($friends) }}"
                        :invitations=" {{ json_encode($invitations) }}"
                        :invited="{{ json_encode($invited) }}"
                        :name="{{ json_encode($user->name) }}"
                        :id="{{ json_encode($user->id) }}"
                    ></add-specificfriend>
                @endif
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-6">
                    @if($profile->image !== null)
                    <img
                        src="{{url('https://pracka-images.s3.eu-central-1.amazonaws.com/images/' . $profile->image)}}"
                        alt="avatar"
                        class="rounded-circle mx-auto d-flex"
                        style="width: 100px; height: 100px"
                    >
                    @else
                        <img
                            src="{{\Illuminate\Support\Facades\Storage::disk('s3')->temporaryUrl('images/default.png', '+60 minutes')}}"
                            alt="avatar"
                            class="rounded-circle mx-auto d-flex"
                            style="width: 100px; height: 100px"
                        >
                    @endif
                </div>
                <div><strong>{{ $user->name }}</strong></div>
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
