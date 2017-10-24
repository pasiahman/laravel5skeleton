@extends('backend.layouts.main')

@section('title', 'Users')


@section('content')
<a class="btn btn-default" href="{{ route('backendUserCreate') }}">Create</a>

{!! Form::open(['data-pjax', 'method' => 'GET', 'route' => 'backendUsers']) !!}
<table class="table table-bordered table-condensed table-striped">
    <thead>
        <tr>
            <th colspan="3">
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
            <th rowspan="2"><button class="btn btn-default btn-xs" type="submit"><i class="fa fa-search"></i> Filter</button></th>
        </tr>
        <tr>
            <th align="center">Filter</th>
            <th align="center">{{ Form::text('name', $request->query('name'), ['class' => 'form-control input-sm']) }}</th>
            <th align="center">{{ Form::text('email', $request->query('email'), ['class' => 'form-control input-sm']) }}</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $i => $user)
        <tr>
            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                {!! Form::open(['class' => 'form-inline', 'method' => 'delete', 'route' => ['backendUserDelete', $user->id]]) !!}
                <a class="btn btn-primary btn-xs" href="{{ route('backendUserUpdate', ['id' => $user->id]) }}"><i class="fa fa-pencil"></i></a>
                <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this?')" type="submit"><i class="fa fa-trash-o"></i></button>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot><tr><td align="center" colspan="4">{!! $users->appends($request->query())->links('vendor.pagination.default-pjax') !!}</td></tr></tfoot>
</table>
{!! Form::close() !!}
@endsection('content')
