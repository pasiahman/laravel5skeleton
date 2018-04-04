@extends('frontend.default.layouts.main')

@section('title', $post->title)
{{-- @section('content_header')@endsection --}}
{{-- @section('breadcrumb')@endsection --}}

{{-- @push('styles')@endpush --}}

@section('content')
    <!-- Blog Post -->

    <!-- Title -->
    <h2>{{ $post->title }}</h2>

    <!-- Author -->
    <p class="lead">
        {{ strtolower(__('cms.by')) }} <a href="{{ route('frontend.users.index', ['email' => $post->author->email]) }}">{{ $post->author->name }}</a>
    </p>

    <!-- Date/Time -->
    <p>
        <i aria-hidden="true" class="fa fa-clock-o"></i> @lang('cms.posted_on') {{ (new \Carbon\Carbon($post->updated_at))->format('d M Y H:i') }}
    </p>

    <hr />

    @php
    $imageId = collect($post->getPostmetaImagesId())->first();
    $medium = \Modules\Media\Models\Media::find($imageId);
    @endphp

    <!-- Preview Image -->
    <div align="center">
        <a data-fancybox href="{{ $medium ? Storage::url($medium->getPostmetaAttachedFile()) : 'http://placehold.it/900x300' }}" target="_blank">
            <img alt="{{ $medium ? $medium->name : '' }}" class="img-responsive" src="{{ $medium ? Storage::url($medium->getPostmetaAttachedFileThumbnail()) : 'http://placehold.it/900x300' }}" />
        </a>
    </div>

    <hr />

    <!-- Post Content -->
    <p class="lead">{{ $post->excerpt }}</p>
    <p>{!! $post->content !!}</p>

    <hr />

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form">
            <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <hr />

    <!-- Posted Comments -->

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Start Bootstrap
                <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        </div>
    </div>

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Start Bootstrap
                <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            <!-- Nested Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Nested Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>
            <!-- End Nested Comment -->
        </div>
    </div>
@endsection
