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
            <a class="btn btn-default btn-sm" href="{{ route('backend.media.create', request()->query()) }}">@lang('cms.create')</a>
        </div>
        <div class="box-body table-responsive">
            <form action="{{ route('backend.media.index') }}" method="get">
                @if (request()->query('layout') == 'media_iframe')
                    <input name="fancybox_to" type="hidden" value="{{ request()->query('fancybox_to') }}" />
                    <input name="layout" type="hidden" value="{{ request()->query('layout') }}" />
                    <input name="mime_type_like" type="hidden" value="{{ request()->query('mime_type_like') }}" />
                @endif

                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-right" colspan="8">
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
                                            @can('backend media trash')
                                                <option {{ request()->query('sort') == 'status,ASC' ? 'selected' : '' }} value="status,ASC">@lang('validation.attributes.status') (↓)</option>
                                                <option {{ request()->query('sort') == 'status,DESC' ? 'selected' : '' }} value="status,DESC">@lang('validation.attributes.status') (↑)</option>
                                            @endcan
                                            <option {{ request()->query('sort') == 'updated_at,ASC' ? 'selected' : '' }} value="updated_at,ASC">@lang('validation.attributes.updated_at') (↓)</option>
                                            <option {{ request()->query('sort') == 'updated_at,DESC' ? 'selected' : '' }} value="updated_at,DESC">@lang('validation.attributes.updated_at') (↑)</option>
                                        </select>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th><input class="table_row_checkbox_all" type="checkbox" /></th>
                            <th></th>
                            <th>@lang('validation.attributes.locale')</th>
                            <th>@lang('validation.attributes.name') <input class="form-control input-sm" name="title" type="text" value="{{ request()->query('title') }}" /></th>
                            <th>
                                @lang('validation.attributes.mime_type')
                                <select class="form-control input-sm" name="mime_type">
                                    <option value=""></option>
                                    @foreach ($model->getMimeTypeOptionsAttribute() as $key => $option)
                                        <option {{ $key == request()->query('mime_type') ? 'selected' : '' }} value="{{ $key }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </th>
                            @can('backend media trash')
                                <th>
                                    @lang('validation.attributes.status')
                                    <select class="form-control input-sm" name="status">
                                        <option value=""></option>
                                        @foreach ($model->getStatusOptionsAttribute() as $key => $option)
                                            <option {{ $key == request()->query('status') ? 'selected' : '' }} value="{{ $key }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </th>
                            @endcan
                            <th>@lang('validation.attributes.updated_at') <input class="datepicker form-control input-sm" data-date-format="yyyy-mm-dd" name="updated_at_date" type="text" value="{{ request()->query('updated_at_date') }}" /></th>
                            <th>
                                <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-search"></i></button>
                                <a
                                    class="btn btn-default btn-xs"
                                    href="{{ route('backend.media.index', array_except(request()->query(), ['page', 'limit', 'sort', 'title', 'mime_type', 'updated_at_date'])) }}"
                                ><i class="fa fa-repeat"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $i => $post)
                            @php ($attached_file = $post->postmetas->where('key', 'attached_file')->first()->value)
                            @php ($attached_file_thumbnail = $post->postmetas->where('key', 'attached_file_thumbnail')->first()->value)
                            <tr>
                                <td align="center"><input class="table_row_checkbox" name="action_id[]" type="checkbox" value="{{ $post->id }}" /></td>
                                <td>
                                    <a
                                    @if (in_array($post->mime_type, $post->mimeTypeImages)) data-fancybox="group" @endif
                                        href="{{ Storage::url($attached_file) }}" target="_blank"
                                        >
                                        <img class="media-object" src="{{ Storage::url($attached_file_thumbnail) }}" style="height: 32px; width: 32px;" />
                                    </a>
                                </td>
                                <td>
                                    @foreach (config('app.languages') as $languageCode => $languageName)
                                        @if ($post->hasTranslation($languageCode))
                                            <a href="{{ route('backend.media.edit', [$post->id] + ['locale' => $languageCode] + request()->query()) }}">
                                                <img src="{{ asset('images/flags/'.$languageCode.'.gif') }}" />
                                            </a>
                                        @else
                                            <a href="{{ route('backend.media.edit', [$post->id] + ['locale' => $languageCode] + request()->query()) }}">
                                                <i class="fa fa-plus-square"></i>
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->mime_type }}</td>
                                @can('backend media trash')
                                    <td>@lang('cms.'.$post->status)</td>
                                @endcan
                                <td>{{ $post->updated_at }}</td>
                                <td align="center">
                                    <a class="btn btn-default btn-xs" href="{{ route('backend.media.edit', ['id' => $post->id] + request()->query()) }}"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-xs" href="{{ route('backend.media.trash', $post->id) }}" onclick="return confirm('@lang('cms.are_you_sure_to_delete_this')?')"><i class="fa fa-trash-o"></i></a>
                                    @can('backend media delete')
                                        <a class="btn btn-danger btn-xs" href="{{ route('backend.media.delete', $post->id) }}" onclick="return confirm('@lang('cms.are_you_sure_to_delete_this_permanently')?')"><i class="fa fa-trash-o"></i></a>
                                    @endcan
                                    @if (request()->query('layout') == 'media_iframe')
                                        <button
                                            class="btn btn-success btn-xs media_choose"
                                            data-attached_file="{{ Storage::url($attached_file) }}"
                                            data-attached_file_thumbnail="{{ Storage::url($attached_file_thumbnail) }}"
                                            data-fancybox_to="{{ request()->query('fancybox_to') }}"
                                            data-media_id="{{ $post->id }}"
                                            data-success-message="@lang('cms.added')"
                                            type="button"
                                        >@lang('cms.choose')</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td align="center" colspan="8">@lang('cms.no_data')</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <select class="input-sm" name="action">
                                    <option value="">@lang('cms.action')</option>
                                    @can('backend media trash')
                                        <option value="publish">@lang('cms.publish')</option>
                                    @endcan
                                    <option value="trash">@lang('cms.trash')</option>
                                    @can('backend media delete')
                                        <option value="delete">@lang('cms.delete')</option>
                                    @endcan
                                </select>
                                <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-play-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="8">{{ $posts->appends(request()->query())->links('vendor.pagination.default') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
@endsection
