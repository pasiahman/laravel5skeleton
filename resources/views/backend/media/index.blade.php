@extends('backend.layouts.main')

@section('title', __('cms.media'))
@section('content_header', __('cms.media'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-upload"></i> @lang('cms.media')</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <a class="btn btn-default" href="{{ route('backendMediumCreate') }}">@lang('cms.create')</a>
        </div>
        <div class="box-body table-responsive">
            {!! Form::open(['method' => 'GET', 'route' => 'backendMedia']) !!}
            <table class="table table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th class="text-right" colspan="6">
                            <div class="form-inline">
                                <div class="form-group">
                                    @lang('cms.per_page')
                                    @php ($limitMedia = ['10' => '10', '25' => '25', '50' => '50', '100' => '100'])
                                    {!! Form::select('limit', $limitMedia, $request->query('limit'), ['class' => 'input-sm']) !!}

                                    @lang('cms.sort')
                                    @php ($sortMedia = ['title,ASC' => __('validation.attributes.name').' (A-Z)', 'title,DESC' => __('validation.attributes.name').' (Z-A)', 'mime_type,ASC' => __('validation.attributes.mime_type').' (A-Z)', 'mime_type,DESC' => __('validation.attributes.mime_type').' (Z-A)', 'created_at,DESC' => __('validation.attributes.created_at').' (↑)', 'created_at,ASC' => __('validation.attributes.created_at').' (↓)'])
                                    {!! Form::select('sort', $sortMedia, $request->query('sort'), ['class' => 'input-sm']) !!}
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th><input class="table_row_checkbox_all" type="checkbox" /></th>
                        <th></th>
                        <th>@lang('validation.attributes.name') {{ Form::text('title', $request->query('name'), ['class' => 'form-control input-sm']) }}</th>
                        <th>@lang('validation.attributes.mime_type') {{ Form::select('mime_type', $mime_type_options, $request->query('value'), ['class' => 'form-control input-sm']) }}</th>
                        <th>@lang('validation.attributes.created_at') {{ Form::text('created_at', $request->query('value'), ['class' => 'form-control input-sm']) }}</th>
                        <th>
                            <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-search"></i></button>
                            <a class="btn btn-default btn-xs" href="{{ route('backendMedia') }}"><i class="fa fa-repeat"></i></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($media as $i => $medium)
                        @php ($attached_file = $medium->postmetas->where('key', 'attached_file')->first()->value)
                        @php ($attached_file_thumbnail = $medium->postmetas->where('key', 'attached_file_thumbnail')->first()->value)
                        <tr>
                            <td align="center"><input class="table_row_checkbox" name="action_id[]" type="checkbox" value="{{ $medium->id }}" /></td>
                            <td>
                                <a
                                    @if (in_array($medium->mime_type, $medium->mimeTypeImages)) data-fancybox="group" @endif
                                    href="{{ Storage::url($attached_file) }}" target="_blank"
                                >
                                    <img class="media-object" src="{{ Storage::url($attached_file_thumbnail) }}" style="height: 32px; width: 32px;" />
                                </a>
                            </td>
                            <td>{{ $medium->title }}</td>
                            <td>{{ $medium->mime_type }}</td>
                            <td>{{ $medium->created_at }}</td>
                            <td align="center">
                                <a class="btn btn-default btn-xs" href="{{ route('backendMediumUpdate', ['id' => $medium->id]) }}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger btn-xs" href="{{ route('backendMediumDelete', $medium->id) }}" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td align="center" colspan="6">@lang('cms.no_data')</td></tr>
                    @endforelse
                </tbody>
                <tfoot><tr><td align="center" colspan="6">{!! $media->appends($request->query())->links('vendor.pagination.default') !!}</td></tr></tfoot>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
