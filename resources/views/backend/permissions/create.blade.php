@extends('backend.layouts.main')

@section('title', 'Create Permission')
@section('content_header', 'Create Permission')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backendPermissions') }}"><i class="fa fa fa-ban"></i>Permissions</a></li>
        <li class="active">Create</li>
    </ol>
@endsection

@section('content')
    @include('backend.permissions._form', ['permission' => $permission])
@endsection
