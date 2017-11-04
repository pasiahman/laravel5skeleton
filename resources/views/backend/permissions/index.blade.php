@extends('backend.layouts.main')

@section('title', 'Permissions')
@section('content_header', 'Permissions')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa fa-ban"></i> Permissions</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <a class="btn btn-default" href="{{ route('backendPermissionCreate') }}">Create</a>
        </div>
        <div class="box-body table-responsive">
            {!! Form::open(['method' => 'GET', 'route' => 'backendPermissions']) !!}
            <table class="table table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th class="text-right" colspan="4">
                            <div class="form-inline">
                                <div class="form-group">
                                    Per page
                                    @php ($limitOptions = ['10' => '10', '25' => '25', '50' => '50', '100' => '100'])
                                    {!! Form::select('limit', $limitOptions, $request->query('limit'), ['class' => 'input-sm']) !!}

                                    Sort
                                    @php ($sortOptions = ['name,ASC' => 'Name (A-Z)', 'name,DESC' => 'Name (Z-A)', 'guard_name,ASC' => 'Guard Name (A-Z)', 'guard_name,DESC' => 'Guard Name (Z-A)'])
                                    {!! Form::select('sort', $sortOptions, $request->query('sort'), ['class' => 'input-sm']) !!}
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Name {{ Form::text('name', $request->query('name'), ['class' => 'form-control input-sm']) }}</th>
                        <th>Guard Name {{ Form::text('guard_name', $request->query('guard_name'), ['class' => 'form-control input-sm']) }}</th>
                        <th>Action <button class="btn btn-block btn-default btn-sm" type="submit"><i class="fa fa-search"></i></button></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $i => $permission)
                        <tr>
                            <td align="center">{{ ($permissions->currentPage() - 1) * $permissions->perPage() + $i + 1 }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td align="center">
                                <a class="btn btn-primary btn-xs" href="{{ route('backendPermissionUpdate', ['id' => $permission->id]) }}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger btn-xs" href="{{ route('backendPermissionDelete', $permission->id) }}" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td align="center" colspan="4">No data</td></tr>
                    @endforelse
                </tbody>
                <tfoot><tr><td align="center" colspan="4">{!! $permissions->appends($request->query())->links('vendor.pagination.default-pjax') !!}</td></tr></tfoot>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
