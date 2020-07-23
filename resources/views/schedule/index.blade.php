@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table-dark">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Visibility</th>
                <th>Description</th>
                <th>Created</th>
                <th>Updated</th>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                    <tr>
                        <th>{{ $schedule->getAttribute('id') }}</th>
                        <th>{{ $schedule->getAttribute('name') }}</th>
                        <th>{{ $schedule->getAttribute('slug') }}</th>
                        <th>{{ $schedule->getAttribute('visibility') }}</th>
                        <th>{{ $schedule->getAttribute('description') }}</th>
                        <th>{{ $schedule->getAttribute('created_at') }}</th>
                        <th>{{ $schedule->getAttribute('updated_at') }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
