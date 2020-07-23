@extends('layouts.app')

@section('content')
    <form action="{{ $action }}" method="POST">
        @isset($method)
            @method($method)
        @endisset
        @csrf
{{--            {{ dd($schedule) }}--}}
        <div class="container">
            <div class="card bg-secondary text-white">
                <div class="card-header">New ToDo</div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="name">{{ __('Creator') }}</label>
                            </div>
                            <div class="col-8">
                                <select name="creator" class="custom-select">
                                    <option value="{{ auth()->user()->getAuthIdentifier() }}">
                                        {{ auth()->user()->username }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="name">{{ __('Schedule') }}</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" readonly value="{{ $schedule->slug }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="email">{{ __('Title') }}</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="email">{{ __('Description') }}</label>
                            </div>
                            <div class="col-8">
                                <textarea name="description" id="description" class="form-control" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <div class="row">
                            <button type="submit" class="btn btn-block btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
