@extends('layouts.app')

@section('content')
    <form action="{{ $action }}" method="POST">
        @isset($method)
            @method($method)
        @endisset
        @csrf
        <div class="container">
            <div class="card bg-secondary text-white">
                <div class="card-header">New Schedule</div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="name">{{ __('Name') }}</label>
                            </div>
                            <div class="col-8">
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" required
                                @isset($schedule)
                                    value="{{ $schedule->getAttribute('name') }}"
                                @endisset
                                >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="email">{{ __('Visibility') }}</label>
                            </div>
                            <div class="col-8">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-light">
                                        <input type="radio" name="visibility" id="role_admin" value="ROLE_ADMIN" autocomplete="off"
                                            @isset($schedule)
                                                @if($schedule->getAttribute('visibility') == 'ROLE_ADMIN')
                                                    checked
                                                @endif
                                            @endisset
                                        > ADMIN
                                    </label>
                                    <label class="btn btn-light">
                                        <input type="radio" name="visibility" id="role_master" value="ROLE_MASTER" autocomplete="off"
                                            @isset($schedule)
                                                @if($schedule->getAttribute('visibility') == 'ROLE_MASTER')
                                                    checked
                                                @endif
                                            @endisset
                                        > MASTER
                                    </label>
                                    <label class="btn btn-light">
                                        <input type="radio" name="visibility" id="role_user" value="ROLE_USER" autocomplete="off"
                                            @isset($schedule)
                                                @if($schedule->getAttribute('visibility') == 'ROLE_USER')
                                                    checked
                                                @endif
                                            @endisset
                                        > USER
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="email">{{ __('Description') }}</label>
                            </div>
                            <div class="col-8">
                                <textarea name="description" id="description" class="form-control" rows="1">@isset($schedule){{ $schedule->getAttribute('description') }}@endisset</textarea>
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
