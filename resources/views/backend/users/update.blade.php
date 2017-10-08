@extends('backend.layouts.main')

@section('title', 'Update User')

@section('content')
    @include('backend.users._form', ['user' => $user])
@endsection('content')
