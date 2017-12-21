@if ($user->id)
    {{ Form::model($user, ['method' => 'put', 'route' => ['backendUserUpdate']]) }}
    {{ Form::hidden('id', $user->id) }}
@else
    {{ Form::model($user, ['route' => 'backendUserCreate']) }}
@endif
<div class="box">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label(__('validation.attributes.name').' (*)') }}
            {{ Form::text('name', old('name', $user->name), ['class' => 'form-control', 'required']) }}
            <i class="text-danger">{{ $errors->first('name') }}</i>
        </div>
        <div class="form-group">
            {{ Form::label(__('validation.attributes.email').' (*)') }}
            {{ Form::email('email', old('email', $user->email), ['class' => 'form-control', 'required']) }}
            <i class="text-danger">{{ $errors->first('email') }}</i>
        </div>
        <div class="form-group">
            {{ Form::label(__('validation.attributes.password')) }}
            {{ Form::password('password', ['class' => 'form-control']) }}
            <i class="text-danger">{{ $errors->first('password') }}</i>
        </div>

        <div class="row">
            @can('backend roles')
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">@lang('cms.roles')</div>
                        <div class="panel-body" style="max-height: 500px; overflow: auto;">
                            @forelse ($roles as $role)
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('roles[]', $role->name, old('roles[]', $user->hasRole($role->name))) }}
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @empty
                                @lang('cms.no_data')
                            @endforelse
                        </div>
                    </div>
                </div>
            @endcan

            @can('backend permissions')
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">@lang('cms.permissions')</div>
                        <div class="panel-body" style="max-height: 500px; overflow: auto;">
                            @if (count($permissions) > 1)
                                <table class="table table-bordered table-condensed">
                                    <tr>
                                        <th>@lang('cms.role_permissions')</th>
                                        <th>@lang('cms.overwrite_permissions')</th>
                                    </tr>
                                    @php ($user_permissions = $user->getDirectPermissions()->pluck('name')->toArray())
                                    @php ($user_roles = $user->getPermissionsViaRoles()->pluck('name')->toArray())
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        {{ Form::checkbox('user_permissions[]', $permission->name, in_array($permission->name, $user_roles), ['disabled']) }}
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        {{ Form::checkbox('permissions[]', $permission->name, old('permissions[]', in_array($permission->name, $user_permissions))) }}
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                @lang('cms.no_data')
                            @endif
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    <div class="box-footer">
        @if ($user->id)
            <input class="btn btn-default" name="update" type="submit" value="@lang('cms.update')" />
        @else
            <input class="btn btn-default" name="create" type="submit" value="@lang('cms.create')" />
        @endif
    </div>
</div>
{{ Form::close() }}
