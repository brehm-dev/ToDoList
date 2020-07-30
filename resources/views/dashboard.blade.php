@extends('layouts.app')

@section('content')
    <instance-loader
        v-bind:current-user="{{ auth()->user() }}"
        v-bind:router="{
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
                    method: 'GET',
                    depend: ['user']
                },
                update: {
                    action: '/user/{user}',
                    method: 'PATCH',
                    depend: ['user']
                },
                delete: {
                    action: '/user/{user}',
                    method: 'DELETE',
                    depend: ['user']
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
                    method: 'GET',
                    depend: ['schedule']
                },
                update: {
                    action: '/schedule/{schedule}',
                    method: 'PATCH',
                    depend: ['schedule']
                },
                delete: {
                    action: '/schedule/{schedule}',
                    method: 'DELETE',
                    depend: ['schedule']
                }
            },
            procedure: {
                index: {
                    action: '/schedule/{schedule}/procedures',
                    method: 'GET',
                    depend: ['schedule']
                },
                create: {
                    action: '/schedule/{schedule}/procedure',
                    method: 'POST',
                    depend: ['schedule']
                },
                view: {
                    action: '/schedule/{schedule}/procedure/{procedure}',
                    method: 'GET',
                    depend: ['schedule', 'procedure']
                },
                update: {
                    action: '/schedule/{schedule}/procedure/{procedure}',
                    method: 'PATCH',
                    depend: ['schedule', 'procedure']
                },
                delete: {
                    action: '/schedule/{schedule}/procedure/{procedure}',
                    method: 'DELETE',
                    depend: ['schedule', 'procedure']
                }
            }
        }"
    ></instance-loader>
@endsection
