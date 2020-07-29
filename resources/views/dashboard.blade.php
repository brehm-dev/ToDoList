@extends('layouts.app')

@section('content')
    <instance-loader
        userIsAdmin="{{ auth()->user()->isRoleAdmin() }}"
        v-bind:routes="{
            user: {
                index: {
                    action: '/users',
                    method: 'GET'
                },
                create: {
                    action: '/user',
                    method: 'POST'
                },
                view: {
                    action: '/user/{user}',
                    method: 'GET'
                },
                update: {
                    action: '/user/{user}',
                    method: 'PATCH'
                },
                delete: {
                    action: '/user/{user}',
                    method: 'DELETE'
                },
            },
            schedule: {
                index: {
                    action: '/schedules',
                    method: 'GET'
                },
            }
        }"
    ></instance-loader>
@endsection
