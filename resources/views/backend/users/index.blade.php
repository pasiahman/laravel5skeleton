@extends('backend.layouts.main')

@section('title', 'Users')


@section('content')
    <a class="btn btn-default" href="{{ route('backendUserCreate') }}">Create</a>

    {!! Form::open(['method' => 'GET', 'route' => 'backendUsers']) !!}
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th colspan="5">
                    <div class="form-inline">
                        <div class="form-group">
                            Per page
                            @php ($limitOptions = ['10' => '10', '25' => '25', '50' => '50', '100' => '100'])
                            {!! Form::select('limit', $limitOptions, $request->query('limit'), ['class' => 'input-sm']) !!}

                            Sort
                            @php ($sortOptions = ['name,ASC' => 'Name (A-Z)', 'name,DESC' => 'Name (Z-A)', 'email,ASC' => 'Email (A-Z)', 'email,DESC' => 'Email (Z-A)'])
                            {!! Form::select('sort', $sortOptions, $request->query('sort'), ['class' => 'input-sm']) !!}
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Name {{ Form::text('name', $request->query('name'), ['class' => 'form-control input-sm']) }}</th>
                <th>Email {{ Form::text('email', $request->query('email'), ['class' => 'form-control input-sm']) }}</th>
                <th>Roles {{ Form::select('role_id', $role->name_options, $request->query('role_id'), ['class' => 'form-control input-sm']) }}</th>
                <th>Action <button class="btn btn-block btn-default btn-sm" type="submit"><i class="fa fa-search"></i> Filter</button></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $i => $user)
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <a href="{{ route('backendRoleUpdate', ['id' => $role->id]) }}">{{ $role->name }}</a><br />
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{ route('backendUserUpdate', ['id' => $user->id]) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('backendUserDelete', $user->id) }}" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @empty
                <tr><td align="center" colspan="4">No data</td></tr>
            @endforelse
        </tbody>
        <tfoot><tr><td align="center" colspan="5">{!! $users->appends($request->query())->links('vendor.pagination.default-pjax') !!}</td></tr></tfoot>
    </table>
    {!! Form::close() !!}
@endsection('content')
