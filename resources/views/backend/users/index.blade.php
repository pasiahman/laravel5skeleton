@extends('backend.layouts.main')

@section('title', 'Users')

@section('content')
<a class="btn btn-default" href="{{ route('backendUserCreate') }}">Create</a>
<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $i => $user)
        <tr>
            <td>{{ $i }}</td>
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
    </thead>
</table>
@endsection('content')
