@extends('backend.layouts.main')

@section('title', 'Create Role')
@section('content_header', 'Create Role')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backendRoles') }}"><i class="fa fa-user"></i>Roles</a></li>
        <li class="active">Create</li>
    </ol>
@endsection

@section('content')
    @include('backend.roles._form', ['role' => $role])
@endsection
