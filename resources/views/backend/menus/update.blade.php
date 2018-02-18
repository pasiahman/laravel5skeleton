@extends('backend.layouts.main')

@section('title', __('cms.update'))
@section('content_header', __('cms.update'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.menus.index', request()->query()) }}">@lang('cms.menus')</a>
        </li>
        <li class="active">@lang('cms.update')</li>
    </ol>
@endsection

@section('content')
    @include('backend/menus/_form')
@endsection
