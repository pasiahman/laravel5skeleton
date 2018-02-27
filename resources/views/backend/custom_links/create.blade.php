@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.custom-links.index', request()->query()) }}">@lang('cms.custom_links')</a>
        </li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.custom-links.store') }}" method="post">
        @include('backend/custom_links/_form')
    </form>
@endsection
