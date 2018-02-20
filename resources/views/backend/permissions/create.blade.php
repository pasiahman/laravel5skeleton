@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.permissions.index', request()->query()) }}">
                <i class="fa fa-ban"></i>@lang('cms.permissions')
            </a>
        </li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.permissions.store') }}" method="post">
        @include('backend/permissions/_form')
    </form>
@endsection
