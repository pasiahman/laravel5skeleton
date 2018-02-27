@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.categories.index', request()->query()) }}">@lang('cms.categories')</a>
        </li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.categories.store') }}" method="post">
        @include('backend/categories/_form')
    </form>
@endsection
