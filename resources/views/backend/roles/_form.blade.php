@if ($role->id)
    {!! Form::model($role, ['method' => 'put', 'route' => ['backendRoleUpdate']]) !!}
    {!! Form::hidden('id', $role->id) !!}
@else
    {!! Form::model($role, ['route' => 'backendRoleCreate']) !!}
@endif

<div class="form-group">
    {!! Form::label('name'.' (*)') !!}
    {!! Form::text('name', old('name', $role->name), ['class' => 'form-control', 'required']) !!}
    <i class="text-danger">{{ $errors->first('name') }}</i>
</div>
<div class="form-group">
    {!! Form::label('guard_name') !!}
    {!! Form::text('guard_name', old('guard_name', $role->guard_name), ['class' => 'form-control']) !!}
    <i class="text-danger">{{ $errors->first('guard_name') }}</i>
</div>

@if ($role->id)
    {!! Form::submit('Update', ['class' => 'btn btn-default', 'name' => 'update']) !!}
@else
    {!! Form::submit('Create', ['class' => 'btn btn-default', 'name' => 'create']) !!}
@endif
{!! Form::close() !!}
