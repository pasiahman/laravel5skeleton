@extends('backend.layouts.main')

@section('title', __('cms.edit'))
@section('content_header', __('cms.edit'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.options.index', request()->query()) }}">
                <i class="fa fa-sliders"></i>@lang('cms.options')
            </a>
        </li>
        <li class="active">@lang('cms.edit')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.options.update', $option->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $option->id }}" />
        @include('backend/options/_form')
    </form>
@endsection
