@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($todos as $schedule)
            <table class="table-dark table-bordered">
                <thead>
                    <th>ID</th>
                    <th>Creator</th>
                    <th>Schedule</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Updated</th>
                </thead>
                <tbody>
                @foreach($schedule as $todo)
                    <tr>
                        <th>{{ $todo->id }}</th>
                        <th>{{ $todo->creatorUser()->username }}</th>
                        <th>{{ $todo->schedule()->name }}</th>
                        <th>{{ $todo->title }}</th>
                        <th>{{ $todo->description }}</th>
                        <th>{{ $todo->created_at }}</th>
                        <th>{{ $todo->updated_at }}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr>
        @endforeach
    </div>
@endsection
