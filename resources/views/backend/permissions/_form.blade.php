@if ($permission->id)
    {!! Form::model($permission, ['method' => 'put', 'route' => ['backendPermissionUpdate']]) !!}
    {!! Form::hidden('id', $permission->id) !!}
@else
    {!! Form::model($permission, ['route' => 'backendPermissionCreate']) !!}
@endif

<div class="form-group">
    {!! Form::label('name'.' (*)') !!}
    {!! Form::text('name', old('name', $permission->name), ['class' => 'form-control', 'required']) !!}
    <i class="text-danger">{{ $errors->first('name') }}</i>
</div>
<div class="form-group">
    {!! Form::label('guard_name') !!}
    {!! Form::text('guard_name', old('guard_name', $permission->guard_name), ['class' => 'form-control']) !!}
    <i class="text-danger">{{ $errors->first('guard_name') }}</i>
</div>

@if ($permission->id)
    {!! Form::submit('Update', ['class' => 'btn btn-default', 'name' => 'update']) !!}
@else
    {!! Form::submit('Create', ['class' => 'btn btn-default', 'name' => 'create']) !!}
@endif
{!! Form::close() !!}
