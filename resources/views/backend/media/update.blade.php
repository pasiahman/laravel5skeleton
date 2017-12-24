@extends('backend.layouts.main')

@section('title', __('cms.update'))
@section('content_header', __('cms.update'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backend.media.index') }}"><i class="fa fa-upload"></i>@lang('cms.media')</a></li>
        <li class="active">@lang('cms.update')</li>
    </ol>
@endsection

@section('content')
    @include('backend/media/_form', ['medium' => $medium])
@endsection
