@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/channel/create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="channel_name"><strong>Nazwa kanału</strong></label>
            <input type="text" class="form-control" name="channel_name" id="channel_name" placeholder="wpisz nazwę kanału" style="width: 50%">

            <label for="image" class="col-1"><strong>Avatar:</strong></label>
            <input type="file" id="image" alt="avatar" name="image" class="@error('image')is-invalid @enderror form-control" style="width: 50%">
            @error('image')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="row my-4">
                <div>
                    <button type="submit" class="btn btn-success col-1 rounded">Stwórz</button>
                    <button href="{{ url('/channel') }}" class="btn btn-danger col-1 rounded">Anuluj</button>
                </div>
            </div>
        </form>
    </div>
@endsection
