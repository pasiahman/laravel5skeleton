@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.users.index', request()->query()) }}">
                <i class="fa fa-users"></i>@lang('cms.users')
            </a>
        </li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    @include('backend/users/_form', ['user' => $user])
@endsection
