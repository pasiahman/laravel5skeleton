@extends('backend.layouts.main')

@section('title', 'Create Role')

@section('content')
    @include('backend.roles._form', ['role' => $role])
@endsection
