@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backendMedia') }}"><i class="fa fa-upload"></i>@lang('cms.media')</a></li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    @include('backend.media._upload', ['medium' => $medium])
@endsection
