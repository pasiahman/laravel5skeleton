@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.medium-categories.index', request()->query()) }}">@lang('cms.medium_categories')</a>
        </li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.medium-categories.store') }}" method="post">
        @include('backend/medium_categories/_form')
    </form>
@endsection
