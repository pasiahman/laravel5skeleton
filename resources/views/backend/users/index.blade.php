@extends('backend.layouts.main')

@section('title', __('cms.users'))
@section('content_header', __('cms.users'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-users"></i> @lang('cms.users')</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <a class="btn btn-default btn-sm" href="{{ route('backend.users.create', request()->input()) }}">@lang('cms.create')</a>
        </div>
        <div class="box-body table-responsive">
            <form action="{{ route('backend.users.index') }}" method="get">
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-right" colspan="5">
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
                                            <option {{ request()->query('sort') == 'email,ASC' ? 'selected' : '' }} value="email,ASC">@lang('validation.attributes.email') (A-Z)</option>
                                            <option {{ request()->query('sort') == 'email,DESC' ? 'selected' : '' }} value="email,DESC">@lang('validation.attributes.email') (Z-A)</option>
                                        </select>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th><input class="table_row_checkbox_all" type="checkbox" /></th>
                            <th>@lang('validation.attributes.name') <input class="form-control input-sm" name="name" type="text" value="{{ request()->query('name') }}" /></th>
                            <th>@lang('validation.attributes.email') <input class="form-control input-sm" name="email" type="text" value="{{ request()->query('email') }}" /></th>
                            @can('backend roles')
                                <th>
                                    @lang('cms.roles')
                                    <select class="form-control input-sm" name="role_id">
                                        <option value=""></option>
                                        @foreach ($role->getNameOptionsAttribute() as $key => $role)
                                            <option {{ $key == request()->query('role_id') ? 'selected' : '' }} value="{{ $key }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </th>
                            @endcan
                            <th>
                                <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-search"></i></button>
                                <a class="btn btn-default btn-xs" href="{{ route('backend.users.index') }}"><i class="fa fa-repeat"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $i => $user)
                            <tr>
                                <td align="center"><input class="table_row_checkbox" name="action_id[]" type="checkbox" value="{{ $user->id }}" /></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @can('backend roles')
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <a href="{{ route('backend.roles.edit', $role->id) }}">{{ $role->name }}</a>
                                            <br />
                                        @endforeach
                                    </td>
                                @endcan
                                <td align="center">
                                    <a class="btn btn-default btn-xs" href="{{ route('backend.users.edit', [$user->id] + request()->query()) }}"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-xs" href="{{ route('backend.users.delete', $user->id) }}" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td align="center" colspan="4">@lang('cms.no_data')</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <select class="input-sm" name="action">
                                    <option value="">@lang('cms.action')</option>
                                    <option value="delete">@lang('cms.delete')</option>
                                </select>
                                <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-play-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="5">{{ $users->appends(request()->query())->links('vendor.pagination.default') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
@endsection
