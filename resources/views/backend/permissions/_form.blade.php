@if ($permission->id)
    {!! Form::model($permission, ['method' => 'put', 'route' => ['backendPermissionUpdate']]) !!}
    {!! Form::hidden('id', $permission->id) !!}
@else
    {!! Form::model($permission, ['route' => 'backendPermissionCreate']) !!}
@endif
<div class="box">
    <div class="box-body">
        <div class="form-group">
            {!! Form::label(__('validation.attributes.name').' (*)') !!}
            {!! Form::text('name', old('name', $permission->name), ['class' => 'form-control', 'required']) !!}
            <i class="text-danger">{{ $errors->first('name') }}</i>
        </div>
        <div class="form-group">
            {!! Form::label(__('validation.attributes.guard_name').' (*)') !!}
            {!! Form::text('guard_name', old('guard_name', $permission->guard_name), ['class' => 'form-control', 'readonly', 'required']) !!}
            <i class="text-danger">{{ $errors->first('guard_name') }}</i>
        </div>
    </div>
    <div class="box-footer">
        @if ($permission->id)
            <input class="btn btn-default" name="update" type="submit" value="@lang('cms.update')" />
        @else
            <input class="btn btn-default" name="create" type="submit" value="@lang('cms.create')" />
        @endif
    </div>
</div>
{!! Form::close() !!}
