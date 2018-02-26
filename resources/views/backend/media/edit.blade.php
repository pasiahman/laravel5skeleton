@extends(request()->query('layout') ? 'backend.layouts.'.request()->query('layout') : 'backend.layouts.main')

@section('title', __('cms.update'))
@section('content_header', __('cms.update'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.media.index', request()->query()) }}">
                <i class="fa fa-upload"></i>@lang('cms.media')
            </a>
        </li>
        <li class="active">@lang('cms.update')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.media.update', $post->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $post->id }}" />
        @include('backend/media/_form')
    </form>
@endsection
