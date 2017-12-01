@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backendRoles') }}"><i class="fa fa-user"></i>@lang('cms.roles')</a></li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    @include('backend.roles._form', ['role' => $role])
@endsection
