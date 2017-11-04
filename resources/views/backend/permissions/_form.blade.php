@if ($permission->id)
    {!! Form::model($permission, ['method' => 'put', 'route' => ['backendPermissionUpdate']]) !!}
    {!! Form::hidden('id', $permission->id) !!}
@else
    {!! Form::model($permission, ['route' => 'backendPermissionCreate']) !!}
@endif
<div class="box">
    <div class="box-body">
        <div class="form-group">
            {!! Form::label('name'.' (*)') !!}
            {!! Form::text('name', old('name', $permission->name), ['class' => 'form-control', 'required']) !!}
            <i class="text-danger">{{ $errors->first('name') }}</i>
        </div>
        <div class="form-group">
            {!! Form::label('guard_name'.' (*)') !!}
            {!! Form::text('guard_name', old('guard_name', $permission->guard_name), ['class' => 'form-control', 'readonly', 'required']) !!}
            <i class="text-danger">{{ $errors->first('guard_name') }}</i>
        </div>
    </div>
    <div class="box-footer">
        @if ($permission->id)
            {!! Form::submit('Update', ['class' => 'btn btn-default', 'name' => 'update']) !!}
        @else
            {!! Form::submit('Create', ['class' => 'btn btn-default', 'name' => 'create']) !!}
        @endif
    </div>
</div>
{!! Form::close() !!}
