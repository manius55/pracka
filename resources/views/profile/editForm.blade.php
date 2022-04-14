@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h3 my-4">Profile edit</div>
    <form action="{{ url('/profile/' . Auth::id()  . '/edit')}}" method="post">
        @csrf
        @method('put')
        <div class="row my-2">
            <div>
                <label for="description" class="col-1"><strong>Description:</strong></label>
                <input type="text" name="description" id="description" value="{{ $profile->description }}" class="col-6 rounded-1">
            </div>
        </div>
        <div class="row my-2">
            <div>
                <label for="date_of_birth" class="col-1"><strong>Date of birth:</strong></label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="rounded" value="{{ $profile->date_of_birth }}">
            </div>
        </div>
        <add-avatar></add-avatar>
        <div class="row my-4">
            <div>
                <button type="submit" class="btn btn-success col-1 rounded">Save</button>
                <button href="{{ url('/profile/' . Auth::id()) }}" class="btn btn-danger col-1 rounded">Cancel</button>
            </div>
        </div>
    </form>
    </div>
@endsection
