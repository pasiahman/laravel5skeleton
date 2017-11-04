@extends('backend.layouts.main')

@section('title', 'Create User')
@section('content_header', 'Create User')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backendUsers') }}"><i class="fa fa fa-users"></i>Users</a></li>
        <li class="active">Create</li>
    </ol>
@endsection

@section('content')
    @include('backend.users._form', ['user' => $user])
@endsection
