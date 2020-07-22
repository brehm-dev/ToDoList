@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($users as $user)
                    <div class="card">
                        <a href="{{ route('read.user', [$user->id]) }}">
                            <div class="card-header">{{ $user->id }}</div>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->username }}</h5>
                            <p class="card-text">{{ $user->email }} {{ $user->role }} {{ $user->created_at }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
