@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.roles.index', request()->query()) }}">
                <i class="fa fa-user"></i>@lang('cms.roles')
            </a>
        </li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.roles.store') }}" method="post">
        @include('backend/roles/_form')
    </form>
@endsection
