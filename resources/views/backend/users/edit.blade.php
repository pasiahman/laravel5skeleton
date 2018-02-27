@extends('backend.layouts.main')

@section('title', __('cms.update'))
@section('content_header', __('cms.update'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.users.index', request()->query()) }}">
                <i class="fa fa-users"></i>@lang('cms.users')
            </a>
        </li>
        <li class="active">@lang('cms.update')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.users.update', $user->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $user->id }}" />
        @include('backend/users/_form')
    </form>
@endsection
