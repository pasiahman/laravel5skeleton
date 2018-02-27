@extends('backend.layouts.main')

@section('title', __('cms.update'))
@section('content_header', __('cms.update'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.roles.index', request()->query()) }}">
                <i class="fa fa-user"></i>@lang('cms.roles')
            </a>
        </li>
        <li class="active">@lang('cms.update')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.roles.update', $role->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $role->id }}" />
        @include('backend/roles/_form')
    </form>
@endsection
