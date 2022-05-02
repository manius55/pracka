@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h3 my-4">Profile edit</div>
    <form action="{{ url('/profile/' . Auth::id()  . '/edit')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row my-2">
            <div>
                <label for="description" class="col-1"><strong>Description:</strong></label>
                <input type="text" name="description" id="description" value="{{ $profile->description }}" class="col-6 form-control" style="width: 50%">
            </div>
        </div>
        <div class="row my-2">
            <div>
                <label for="date_of_birth" class="col-1"><strong>Date of birth:</strong></label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $profile->date_of_birth }}" style="width: 25%">
            </div>
        </div>
        <label for="image" class="col-1"><strong>Avatar:</strong></label>
        <input type="file" id="image" alt="avatar" name="image" class="@error('image')is-invalid @enderror form-control" style="width: 50%">
        @error('image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="row my-4">
            <div>
                <button type="submit" class="btn btn-success col-1 rounded">Save</button>
                <button href="{{ url('/profile/' . Auth::id()) }}" class="btn btn-danger col-1 rounded">Cancel</button>
            </div>
        </div>
    </form>
    </div>
@endsection
