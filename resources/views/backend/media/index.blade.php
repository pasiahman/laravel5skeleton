@extends(request()->query('layout') ? 'backend.layouts.'.request()->query('layout') : 'backend.layouts.main')

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
            <a class="btn btn-default" href="{{ route('backend.media.create', request()->query()) }}">@lang('cms.create')</a>
        </div>
        <div class="box-body table-responsive">
            <form action="{{ route('backend.media.index') }}" method="get">
                @if (request()->query('layout') == 'media_iframe')
                    <input name="fancybox_to" type="hidden" value="{{ request()->query('fancybox_to') }}" />
                    <input name="layout" type="hidden" value="{{ request()->query('layout') }}" />
                @endif

                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-right" colspan="6">
                                <div class="form-inline">
                                    <div class="form-group">
                                        @lang('cms.per_page')
                                        <select class="input-sm" name="limit">
                                            <option {{ request()->query('limit') == '10' ? 'selected' : '' }} value="10">10</option>
                                            <option {{ request()->query('limit') == '25' ? 'selected' : '' }} value="25">25</option>
                                            <option {{ request()->query('limit') == '50' ? 'selected' : '' }} value="50">50</option>
                                            <option {{ request()->query('limit') == '100' ? 'selected' : '' }} value="100">100</option>
                                        </select>
                                        @lang('cms.sort')
                                        <select class="input-sm" name="sort">
                                            <option {{ request()->query('sort') == 'title,ASC' ? 'selected' : '' }} value="title,ASC">@lang('validation.attributes.name') (A-Z)</option>
                                            <option {{ request()->query('sort') == 'title,DESC' ? 'selected' : '' }} value="title,DESC">@lang('validation.attributes.name') (Z-A)</option>
                                            <option {{ request()->query('sort') == 'mime_type,ASC' ? 'selected' : '' }} value="mime_type,ASC">@lang('validation.attributes.mime_type') (A-Z)</option>
                                            <option {{ request()->query('sort') == 'mime_type,DESC' ? 'selected' : '' }} value="mime_type,DESC">@lang('validation.attributes.mime_type') (Z-A)</option>
                                            <option {{ request()->query('sort') == 'created_at,ASC' ? 'selected' : '' }} value="created_at,ASC">@lang('validation.attributes.created_at') (↓)</option>
                                            <option {{ request()->query('sort') == 'created_at,DESC' ? 'selected' : '' }} value="created_at,DESC">@lang('validation.attributes.created_at') (↑)</option>
                                        </select>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th><input class="table_row_checkbox_all" type="checkbox" /></th>
                            <th></th>
                            <th>@lang('validation.attributes.name') <input class="form-control input-sm" name="title" type="text" value="{{ request()->query('title') }}" /></th>
                            <th>
                                @lang('validation.attributes.mime_type')
                                <select class="form-control input-sm" name="mime_type">
                                    <option value=""></option>
                                    @foreach ($mime_type_options as $key => $option)
                                        <option {{ $key == request()->query('mime_type') ? 'selected' : '' }} value="{{ $key }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th>@lang('validation.attributes.created_at') <input class="datepicker form-control input-sm" name="created_at_date" type="text" value="{{ request()->query('created_at_date') }}" /></th>
                            <th>
                                <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-search"></i></button>
                                <a
                                    class="btn btn-default btn-xs"
                                    href="{{ route('backend.media.index', ['fancybox_to' => request()->query('fancybox_to'), 'layout' => request()->query('layout')]) }}"
                                ><i class="fa fa-repeat"></i></a>
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
                                    <a class="btn btn-default btn-xs" href="{{ route('backend.media.edit', ['id' => $medium->id] + request()->query()) }}"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-xs" href="{{ route('backend.media.delete', $medium->id) }}" onclick="return confirm('@lang('cms.are_you_sure_to_delete_this')?')"><i class="fa fa-trash-o"></i></a>
                                    @if (request()->query('layout') == 'media_iframe')
                                        <button
                                            class="btn btn-success btn-xs media_choose"
                                            data-attached_file="{{ Storage::url($attached_file) }}"
                                            data-attached_file_thumbnail="{{ Storage::url($attached_file_thumbnail) }}"
                                            data-fancybox_to="{{ request()->query('fancybox_to') }}"
                                            data-media_id="{{ $medium->id }}"
                                            data-success-message="@lang('cms.added')"
                                            type="button"
                                        >@lang('cms.choose')</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td align="center" colspan="6">@lang('cms.no_data')</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <select class="input-sm" name="action">
                                    <option value="">@lang('cms.action')</option>
                                    <option value="delete">@lang('cms.delete')</option>
                                </select>
                                <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-play-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="6">{{ $media->appends(request()->query())->links('vendor.pagination.default') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
@endsection
