@extends('layouts.app')

@section('content')
    <div class="container">
    <form action="{{ url('/channel/' . $channel->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="channel_name"><strong>Nazwa kanału</strong></label>
        <input type="text" class="form-control" name="channel_name" id="channel_name" value="{{ $channel->channel_name }}" style="width: 50%">

        <label for="image" class="col-1"><strong>Avatar:</strong></label>
        <input type="file" id="image" alt="avatar" name="image" class="@error('image')is-invalid @enderror form-control" style="width: 50%">

        <div class="row my-4">
            <div>
                <button type="submit" class="btn btn-success col-1 rounded">Stwórz</button>
                <a href="{{ url('/channelUsers/' . $channel->id) }}" class="btn btn-danger col-1 rounded">Anuluj</a>
            </div>
        </div>
    </form>
    </div>
@endsection
