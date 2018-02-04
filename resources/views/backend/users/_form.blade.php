@if ($user->id)
    <form action="{{ route('backend.users.update', $user->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $user->id }}" />
@else
    <form action="{{ route('backend.users.store') }}" method="post">
@endif

    {{ csrf_field() }}
    <div class="box">
        <div class="box-body">
            <div class="form-group">
                <label>@lang('validation.attributes.name') (*)</label>
                <input class="form-control input-sm" name="name" required type="text" value="{{ request()->old('name', $user->name) }}" />
                <i class="text-danger">{{ $errors->first('name') }}</i>
            </div>
            <div class="form-group">
                <label>@lang('validation.attributes.email') (*)</label>
                <input class="form-control input-sm" name="email" required type="email" value="{{ request()->old('email', $user->email) }}" />
                <i class="text-danger">{{ $errors->first('email') }}</i>
            </div>
            <div class="form-group">
                <label>
                    @lang('validation.attributes.password')
                    @if (! $user->id) (*) @endif
                </label>
                <input class="form-control input-sm" name="password" type="password" />
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
                                            <input
                                                @if (is_array(request()->old('roles')))
                                                    {{ in_array($role->name, request()->old('roles')) ? 'checked' : '' }}
                                                @else
                                                    {{ $user->hasRole($role->name) ? 'checked' : '' }}
                                                @endif
                                                name="roles[]" type="checkbox" value="{{ $role->name }}"
                                            />
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
                                                            <input {{ in_array($permission->name, $user_roles) ? 'checked' : '' }} disabled type="checkbox" />
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input
                                                                @if (is_array(request()->old('permissions')))
                                                                    {{ in_array($permission->name, request()->old('permissions')) ? 'checked' : '' }}
                                                                @else
                                                                    {{ in_array($permission->name, $user_permissions) ? 'checked' : '' }}
                                                                @endif
                                                                name="permissions[]" type="checkbox" value="{{ $permission->name }}"
                                                            />
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
            <input class="btn btn-default btn-sm" type="submit" value="@lang('cms.save')" />
        </div>
    </div>
</form>
