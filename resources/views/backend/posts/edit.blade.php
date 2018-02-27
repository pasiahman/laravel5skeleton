@extends('backend.layouts.main')

@section('title', __('cms.update'))
@section('content_header', __('cms.update'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.posts.index', request()->query()) }}">@lang('cms.posts')</a>
        </li>
        <li class="active">@lang('cms.update')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.posts.update', $post->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $post->id }}" />
        @include('backend/posts/_form')
    </form>
@endsection
