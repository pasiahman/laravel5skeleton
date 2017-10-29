@extends('backend.layouts.main')

@section('title', 'Create User')

@section('content')
    @include('backend.users._form', ['user' => $user])
@endsection('content')
