@extends('backend.layouts.main')

@section('title', __('cms.update'))
@section('content_header', __('cms.update'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.permissions.index', request()->query()) }}">
                <i class="fa fa-ban"></i>@lang('cms.permissions')
            </a>
        </li>
        <li class="active">@lang('cms.update')</li>
    </ol>
@endsection

@section('content')
    @include('backend/permissions/_form')
@endsection
