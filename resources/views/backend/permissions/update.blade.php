@extends('backend.layouts.main')

@section('title', 'Update Permission')
@section('content_header', 'Update Permission')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backendPermissions') }}"><i class="fa fa-user"></i>Permissions</a></li>
        <li class="active">Update</li>
    </ol>
@endsection

@section('content')
    @include('backend.permissions._form', ['permission' => $permission])
@endsection
