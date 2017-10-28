@extends('backend.layouts.main')

@section('title', 'Update Role')

@section('content')
    @include('backend.roles._form', ['role' => $role])
@endsection('content')
