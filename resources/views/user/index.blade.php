@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table-dark table-bordered">
            <thead>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>RemToken</th>
            <th>verified</th>
            <th>Created</th>
            <th>Updated</th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                    <th><a href="{{ route('read.user', [$user]) }}">{{ $user->username }}</a></th>
                    <th>{{ $user->email }}</th>
                    <th>{{ $user->role }}</th>
                    <th>{{ $user->remember_token }}</th>
                    <th>{{ $user->email_verified_at }}</th>
                    <th>{{ $user->created_at }}</th>
                    <th>{{ $user->updated_at }}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
