@extends('frontend.default.layouts.main')

{{-- @section('title')@endsection --}}
{{-- @section('content_header')@endsection --}}
{{-- @section('breadcrumb')@endsection --}}

{{-- @push('styles')@endpush --}}

@section('content')
    <!-- Blog Post -->
    @foreach ($posts as $post)
        <h2>
            <a href="{{ route('frontend.posts.show', ['name' => $post->name]) }}">{{ $post->title }}</a>
        </h2>
        <p class="lead">
            {{ strtolower(__('cms.by')) }} <a href="{{ route('frontend.users.index', ['email' => $post->author->email]) }}">{{ $post->author->name }}</a>
        </p>
        <p>
            <i aria-hidden="true" class="fa fa-clock-o"></i> @lang('cms.posted_on') {{ (new \Carbon\Carbon($post->updated_at))->format('d M Y H:i') }}
        </p>
        <hr />

        @php
        $imageId = collect($post->getPostmetaImagesId())->first();
        $medium = \App\Http\Models\Media::find($imageId);
        @endphp

        <div align="center">
            <img alt="{{ $medium ? $medium->name : '' }}" class="img-responsive" src="{{ $medium ? Storage::url($medium->getPostmetaAttachedFileThumbnail()) : 'http://placehold.it/900x300' }}" />
        </div>
        <hr />
        <p>{{ $post->excerpt }}</p>
        <a class="btn btn-primary" href="{{ route('frontend.posts.show', ['name' => $post->name]) }}">@lang('cms.read_more') <i aria-hidden="true" class="fa fa-chevron-right"></i></a>
        <hr />
    @endforeach

    <!-- Pager -->
    {{ $posts->appends(request()->query())->links('vendor/pagination/default-blog') }}
@endsection
