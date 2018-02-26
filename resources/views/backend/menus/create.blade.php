@extends('backend.layouts.main')

@section('title', __('cms.create'))
@section('content_header', __('cms.create'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.menus.index', request()->query()) }}">@lang('cms.menus')</a>
        </li>
        <li class="active">@lang('cms.create')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.menus.store') }}" id="menu_form" method="post">
        @include('backend/menus/_form')
    </form>
@endsection
