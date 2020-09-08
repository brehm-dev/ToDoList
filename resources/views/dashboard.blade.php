<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">


    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                        @canany(['viewAny','view','create','update','delete'], App\User::class)
                            <li class="nav-item">
                                <router-link :to="{ name: 'UserIndex' }" class="nav-link">User</router-link>
                            </li>
{{--                            <user-nav-link--}}
{{--                                user-index-route="{{ route('user.index') }}"--}}
{{--                            ></user-nav-link>--}}
                        @endcanany
                        @canany(['viewAny','view','create','update','delete'], App\Schedule::class)
                            <li class="nav-item">
                                <router-link :to="{ name: 'ScheduleIndex' }" class="nav-link">Schedule</router-link>
                            </li>
{{--                            <schedule-nav-link--}}
{{--                                schedule-index-route="{{ route('schedule.index') }}"--}}
{{--                            ></schedule-nav-link>--}}
                        @endcanany
                        <li class="nav-item dropdown">
                            <a id="navbarDropdownUser" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(isset(Auth::user()->username))
                                    {{ Auth::user()->username }}
                                @else
                                    {{ Auth::user()->email }}
                                @endif
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownUser">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <router-view></router-view>
    </main>
</div>
</body>
</html>





{{--@section('content')--}}
{{--    <instance-loader--}}
{{--        v-bind:current-user="{{ auth()->user() }}"--}}
{{--        v-bind:router="{--}}
{{--            user: {--}}
{{--                index: {--}}
{{--                    action: '/users',--}}
{{--                    method: 'GET'--}}
{{--                },--}}
{{--                create: {--}}
{{--                    action: '/user',--}}
{{--                    method: 'POST'--}}
{{--                },--}}
{{--                view: {--}}
{{--                    action: '/user/{user}',--}}
{{--                    method: 'GET',--}}
{{--                    depend: ['user']--}}
{{--                },--}}
{{--                update: {--}}
{{--                    action: '/user/{user}',--}}
{{--                    method: 'PATCH',--}}
{{--                    depend: ['user']--}}
{{--                },--}}
{{--                delete: {--}}
{{--                    action: '/user/{user}',--}}
{{--                    method: 'DELETE',--}}
{{--                    depend: ['user']--}}
{{--                },--}}
{{--            },--}}
{{--            schedule: {--}}
{{--                index: {--}}
{{--                    action: '/schedules',--}}
{{--                    method: 'GET'--}}
{{--                },--}}
{{--                create: {--}}
{{--                    action: '/schedule',--}}
{{--                    method: 'POST'--}}
{{--                },--}}
{{--                view: {--}}
{{--                    action: '/schedule/{schedule}',--}}
{{--                    method: 'GET',--}}
{{--                    depend: ['schedule']--}}
{{--                },--}}
{{--                update: {--}}
{{--                    action: '/schedule/{schedule}',--}}
{{--                    method: 'PATCH',--}}
{{--                    depend: ['schedule']--}}
{{--                },--}}
{{--                delete: {--}}
{{--                    action: '/schedule/{schedule}',--}}
{{--                    method: 'DELETE',--}}
{{--                    depend: ['schedule']--}}
{{--                }--}}
{{--            },--}}
{{--            procedure: {--}}
{{--                index: {--}}
{{--                    action: '/schedule/{schedule}/procedures',--}}
{{--                    method: 'GET',--}}
{{--                    depend: ['schedule']--}}
{{--                },--}}
{{--                create: {--}}
{{--                    action: '/schedule/{schedule}/procedure',--}}
{{--                    method: 'POST',--}}
{{--                    depend: ['schedule']--}}
{{--                },--}}
{{--                view: {--}}
{{--                    action: '/schedule/{schedule}/procedure/{procedure}',--}}
{{--                    method: 'GET',--}}
{{--                    depend: ['schedule', 'procedure']--}}
{{--                },--}}
{{--                update: {--}}
{{--                    action: '/schedule/{schedule}/procedure/{procedure}',--}}
{{--                    method: 'PATCH',--}}
{{--                    depend: ['schedule', 'procedure']--}}
{{--                },--}}
{{--                delete: {--}}
{{--                    action: '/schedule/{schedule}/procedure/{procedure}',--}}
{{--                    method: 'DELETE',--}}
{{--                    depend: ['schedule', 'procedure']--}}
{{--                }--}}
{{--            }--}}
{{--        }"--}}
{{--    ></instance-loader>--}}
{{--@endsection--}}
