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
            <a class="btn btn-default" href="{{ route('backendUserCreate') }}">@lang('cms.create')</a>
        </div>
        <div class="box-body table-responsive">
            {{ Form::open(['method' => 'GET', 'route' => 'backendUsers']) }}
            <table class="table table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th class="text-right" colspan="5">
                            <div class="form-inline">
                                <div class="form-group">
                                    @lang('cms.per_page')
                                    @php ($limitOptions = ['10' => '10', '25' => '25', '50' => '50', '100' => '100'])
                                    {{ Form::select('limit', $limitOptions, $request->query('limit'), ['class' => 'input-sm']) }}

                                    @lang('cms.sort')
                                    @php ($sortOptions = ['name,ASC' => __('validation.attributes.name').' (A-Z)', 'name,DESC' => __('validation.attributes.name').' (Z-A)', 'email,ASC' => __('validation.attributes.email').' (A-Z)', 'email,DESC' => __('validation.attributes.email').' (Z-A)'])
                                    {{ Form::select('sort', $sortOptions, $request->query('sort'), ['class' => 'input-sm']) }}
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th><input class="table_row_checkbox_all" type="checkbox" /></th>
                        <th>@lang('validation.attributes.name') {{ Form::text('name', $request->query('name'), ['class' => 'form-control input-sm']) }}</th>
                        <th>@lang('validation.attributes.email') {{ Form::text('email', $request->query('email'), ['class' => 'form-control input-sm']) }}</th>
                        @can('backend roles')
                            <th>@lang('cms.roles') {{ Form::select('role_id', ['' => ''] + $role->name_options, $request->query('role_id'), ['class' => 'form-control input-sm']) }}</th>
                        @endcan
                        <th>
                            <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-search"></i></button>
                            <a class="btn btn-default btn-xs" href="{{ route('backendUsers') }}"><i class="fa fa-repeat"></i></a>
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
                                        <a href="{{ route('backendRoleUpdate', ['id' => $role->id]) }}">{{ $role->name }}</a><br />
                                    @endforeach
                                </td>
                            @endcan
                            <td align="center">
                                <a class="btn btn-default btn-xs" href="{{ route('backendUserUpdate', ['id' => $user->id]) }}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger btn-xs" href="{{ route('backendUserDelete', $user->id) }}" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td align="center" colspan="4">@lang('cms.no_data')</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            {{ Form::select('action', ['' => __('cms.action'), 'delete' => __('cms.delete')], '', ['class' => 'input-sm']) }}
                            <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-play-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="5">{{ $users->appends($request->query())->links('vendor.pagination.default') }}</td>
                    </tr>
                </tfoot>
            </table>
            {{ Form::close() }}
        </div>
    </div>
@endsection
