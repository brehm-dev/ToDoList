@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">New Schedule</div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="name">{{ __('Name') }}</label>
                        </div>
                        <div class="col-8">
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" required>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
