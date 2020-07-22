@extends('layouts.app')

@section('content')
    <form action="{{ route('user.create.post') }}" method="POST">
        @csrf
        <div class="container">
            <div class="card">
                <div class="card-header">Titel</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Username:</span>
                                </div>
                                <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" required>
                            </div>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </li>
                        <li class="list-group-item">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input.email">Email:</span>
                                </div>
                                <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" aria-describedby="basic-addon3" required>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4">{{ __('Password') }}</span>
                                </div>
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"  id="password" aria-describedby="basic-addon3" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4">{{ __('Confirm Password') }}</span>
                                </div>
                                <input name="password" type="password" class="form-control"  id="password" autocomplete="new-password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </li>
                        <li class="list-group-item">
                            <span class="badge badge-secondary">Role</span>
                            <select class="custom-select" name="role">
                                <option value="ROLE_ADMIN">ADMIN</option>
                                <option value="ROLE_MASTER">MASTER</option>
                                <option value="ROLE_USER" selected>USER</option>
                            </select>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection

