@extends('backend.layouts.main')

@section('title', __('cms.update'))
@section('content_header', __('cms.update'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.tags.index', request()->query()) }}">@lang('cms.tags')</a>
        </li>
        <li class="active">@lang('cms.update')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.tags.update', $term->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $term->id }}" />
        @include('backend/tags/_form')
    </form>
@endsection
