@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backend.options.index') }}"><i class="fa fa-sliders"></i>@lang('cms.options')</a></li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    @include('backend/options/_form', ['option' => $option])
@endsection
