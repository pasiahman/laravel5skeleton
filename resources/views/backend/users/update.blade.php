@extends('backend.layouts.main')

@section('title', __('cms.update'))
@section('content_header', __('cms.update'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.users.index', request()->query()) }}">
                <i class="fa fa-users"></i>@lang('cms.users')
            </a>
        </li>
        <li class="active">@lang('cms.update')</li>
    </ol>
@endsection

@section('content')
    @include('backend/users/_form')
@endsection
