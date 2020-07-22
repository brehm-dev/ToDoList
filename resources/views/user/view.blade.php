@extends('layouts.app')

@section('content')
    <form action="{{ $action }}" method="POST">
        @method($method)
        @csrf
        <div class="container">
            <div class="card bg-secondary text-white">
                <div class="card-header">Update User</div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="username">{{ __('Username') }}</label>
                            </div>
                            <div class="col-8">
                                <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" required value="{{ $user->username }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="email">{{ __('Email') }}</label>
                            </div>
                            <div class="col-8">
                                <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" aria-describedby="basic-addon3" required value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="email">{{ __('Password') }}</label>
                            </div>
                            <div class="col-8">
                                <button type="button" class="btn btn-warning">{{ __('Update Password') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="email">{{ __('Rolle') }}</label>
                            </div>
                            <div class="col-8">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-light">
                                        <input type="radio" name="role" id="role_admin" value="ROLE_ADMIN" autocomplete="off"> ADMIN
                                    </label>
                                    <label class="btn btn-light">
                                        <input type="radio" name="role" id="role_master" value="ROLE_MASTER" autocomplete="off"> MASTER
                                    </label>
                                    <label class="btn btn-light">
                                        <input type="radio" name="role" id="role_user" value="ROLE_USER" autocomplete="off"> USER
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <div class="row">
                            <button type="submit" class="btn btn-block btn-primary">{{ $method }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

