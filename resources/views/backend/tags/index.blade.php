@extends('backend.layouts.main')

@section('title', __('cms.tags'))
@section('content_header', __('cms.tags'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active">@lang('cms.tags')</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <a class="btn btn-default btn-sm" href="{{ route('backend.tags.create', request()->query()) }}">@lang('cms.create')</a>
        </div>
        <div class="box-body table-responsive">
            <form action="{{ route('backend.tags.index') }}" method="get">
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-right" colspan="7">
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
                                            <option {{ request()->query('sort') == 'name,ASC' ? 'selected' : '' }} value="name,ASC">@lang('validation.attributes.name') (A-Z)</option>
                                            <option {{ request()->query('sort') == 'name,DESC' ? 'selected' : '' }} value="name,DESC">@lang('validation.attributes.name') (Z-A)</option>
                                            <option {{ request()->query('sort') == 'slug,ASC' ? 'selected' : '' }} value="slug,ASC">@lang('validation.attributes.slug') (A-Z)</option>
                                            <option {{ request()->query('sort') == 'slug,DESC' ? 'selected' : '' }} value="slug,DESC">@lang('validation.attributes.slug') (Z-A)</option>
                                            <option {{ request()->query('sort') == 'description,ASC' ? 'selected' : '' }} value="description,ASC">@lang('validation.attributes.description') (A-Z)</option>
                                            <option {{ request()->query('sort') == 'description,DESC' ? 'selected' : '' }} value="description,DESC">@lang('validation.attributes.description') (Z-A)</option>
                                            <option {{ request()->query('sort') == 'count,ASC' ? 'selected' : '' }} value="count,ASC">@lang('validation.attributes.count') (↓)</option>
                                            <option {{ request()->query('sort') == 'count,DESC' ? 'selected' : '' }} value="count,DESC">@lang('validation.attributes.count') (↑)</option>
                                        </select>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th><input class="table_row_checkbox_all" type="checkbox" /></th>
                            <th>@lang('validation.attributes.locale')</th>
                            <th>@lang('validation.attributes.name') <input class="form-control input-sm" name="name" type="text" value="{{ request()->query('name') }}" /></th>
                            <th>@lang('validation.attributes.slug') <input class="form-control input-sm" name="slug_like" type="text" value="{{ request()->query('slug_like') }}" /></th>
                            <th>@lang('validation.attributes.description') <input class="form-control input-sm" name="description" type="text" value="{{ request()->query('description') }}" /></th>
                            <th>
                                @lang('validation.attributes.count')
                                <select class="form-control input-sm" name="count_operator">
                                    <option value="">=</option>
                                    <option {{ request()->query('count_operator') == '>' ? 'selected' : '' }} value=">">></option>
                                    <option {{ request()->query('count_operator') == '<' ? 'selected' : '' }} value="<"><</option>
                                </select>
                                <input class="form-control input-sm" name="count" type="number" value="{{ request()->query('count') }}" />
                            </th>
                            <th>
                                <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-search"></i></button>
                                <a class="btn btn-default btn-xs" href="{{ route('backend.tags.index') }}"><i class="fa fa-repeat"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tags as $i => $tag)
                            <tr>
                                <td align="center"><input class="table_row_checkbox" name="action_id[]" type="checkbox" value="{{ $tag->id }}" /></td>
                                <td>
                                    @foreach (config('app.languages') as $languageCode => $languageName)
                                        @if ($tag->hasTranslation($languageCode))
                                            <a href="{{ route('backend.tags.edit', [$tag->id] + ['locale' => $languageCode]) }}">
                                                <img src="{{ asset('images/flags/'.$languageCode.'.gif') }}" />
                                            </a>
                                        @else
                                            <a href="{{ route('backend.tags.edit', [$tag->id] + ['locale' => $languageCode]) }}">
                                                <i class="fa fa-plus-square"></i>
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>{{ $tag->description }}</td>
                                <td align="right">{{ $tag->count }}</td>
                                <td align="center">
                                    <a class="btn btn-default btn-xs" href="{{ route('backend.tags.edit', [$tag->id] + request()->query()) }}"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-xs" href="{{ route('backend.tags.delete', $tag->id) }}" onclick="return confirm('@lang('cms.are_you_sure_to_delete_this_permanently')?')"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td align="center" colspan="7">@lang('cms.no_data')</td>
                            </tr>
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
                            <td align="center" colspan="7">{{ $tags->appends(request()->query())->links('vendor.pagination.default') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
@endsection
