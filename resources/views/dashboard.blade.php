@extends('layouts.app')

@section('content')
{{--    {{ dd(gettype(auth()->user()->isRoleAdmin())) }}--}}
    <instance-loader
        v-bind:current-user="{{ auth()->user() }}"
        v-bind:all-routes="{
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
                create: {
                    action: '/schedule',
                    method: 'POST'
                },
                view: {
                    action: '/schedule/{schedule}',
                    method: 'GET'
                },
                update: {
                    action: '/schedule/{schedule}',
                    method: 'PATCH'
                },
                delete: {
                    action: '/schedule/{schedule}',
                    method: 'DELETE'
                }
            },
            procedure: {
                index: {
                    action: '/schedule/{schedule}/procedures',
                    method: 'GET'
                },
                create: {
                    action: '/schedule/{schedule}/procedure',
                    method: 'POST'
                },
                view: {
                    action: '/schedule/{schedule}/procedure/{procedure}',
                    method: 'GET'
                },
                update: {
                    action: '/schedule/{schedule}/procedure/{procedure}',
                    method: 'PATCH'
                },
                delete: {
                    action: '/schedule/{schedule}/procedure/{procedure}',
                    method: 'DELETE'
                }
            }
        }"
    ></instance-loader>
@endsection
