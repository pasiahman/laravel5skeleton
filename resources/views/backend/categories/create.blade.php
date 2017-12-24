@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backend.categories.index') }}">@lang('cms.categories')</a></li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    @include('backend/categories/_form', ['category' => $category])
@endsection
