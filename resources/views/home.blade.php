@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Komunikat strony głównej</div>

                <div class="card-body">
                    @if (\Illuminate\Support\Facades\Auth::check())
                        <div class="h3">Cześć {{ $name ?? '' }}, jesteś zalogowany</div>
                    @else
                        <div class="h3">
                        Cześć, musisz się zalogować.
                        <a href="{{ url('/login') }}">Log in</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
