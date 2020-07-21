@extends('layouts.app')

@section('content')
    <create-component :data="{{ json_encode($data) }}"></create-component>
@endsection

