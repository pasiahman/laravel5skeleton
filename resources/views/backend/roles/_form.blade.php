@if ($role->id)
    {!! Form::model($role, ['method' => 'put', 'route' => ['backendRoleUpdate']]) !!}
    {!! Form::hidden('id', $role->id) !!}
@else
    {!! Form::model($role, ['route' => 'backendRoleCreate']) !!}
@endif
<div class="box">
    <div class="box-body">
        <div class="form-group">
            {!! Form::label(__('validation.attributes.name').' (*)') !!}
            {!! Form::text('name', old('name', $role->name), ['class' => 'form-control', 'required']) !!}
            <i class="text-danger">{{ $errors->first('name') }}</i>
        </div>
        <div class="form-group">
            {!! Form::label(__('validation.attributes.guard_name').' (*)') !!}
            {!! Form::text('guard_name', old('guard_name', $role->guard_name), ['class' => 'form-control', 'readonly', 'required']) !!}
            <i class="text-danger">{{ $errors->first('guard_name') }}</i>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">@lang('cms.permissions')</div>
            <div class="panel-body" style="max-height: 300px; overflow: auto;">
                @forelse ($permissions as $permission)
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('permissions[]', $permission->name, old('permissions[]', $role->hasPermissionTo($permission->name))) !!}
                            {!! $permission->name !!}
                        </label>
                    </div>
                @empty
                    @lang('cms.no_data')
                @endforelse
            </div>
        </div>
    </div>
    <div class="box-footer">
        @if ($role->id)
            <input class="btn btn-default" name="update" type="submit" value="@lang('cms.update')" />
        @else
            <input class="btn btn-default" name="create" type="submit" value="@lang('cms.create')" />
        @endif
    </div>
</div>
{!! Form::close() !!}
