@if ($user->id)
    {!! Form::model($user, ['method' => 'put', 'route' => ['backendUserUpdate']]) !!}
    {!! Form::hidden('id', $user->id) !!}
@else
    {!! Form::model($user, ['route' => 'backendUserCreate']) !!}
@endif

<div class="form-group">
    {!! Form::label('name'.' (*)') !!}
    {!! Form::text('name', old('name', $user->name), ['class' => 'form-control', 'required']) !!}
    <i class="text-danger">{{ $errors->first('name') }}</i>
</div>
<div class="form-group">
    {!! Form::label('email'.' (*)') !!}
    {!! Form::email('email', old('email', $user->email), ['class' => 'form-control', 'required']) !!}
    <i class="text-danger">{{ $errors->first('email') }}</i>
</div>
<div class="form-group">
    {!! Form::label('password') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
    <i class="text-danger">{{ $errors->first('password') }}</i>
</div>

<div class="row">
    @can('backend roles')
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Roles</div>
                <div class="panel-body" style="max-height: 500px; overflow: auto;">
                    @forelse ($roles as $role)
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('roles[]', $role->name, old('roles[]', $user->hasRole($role->name))) !!}
                                {!! $role->name !!}
                            </label>
                        </div>
                    @empty
                        No data
                    @endforelse
                </div>
            </div>
        </div>
    @endcan

    @can('backend permissions')
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Permissions</div>
                <div class="panel-body" style="max-height: 500px; overflow: auto;">
                    @if (count($permissions) > 1)
                        <table class="table table-bordered table-condensed">
                            <tr>
                                <th>Role permissions</th>
                                <th>Overwrite permissions</th>
                            </tr>
                            @php ($user_permissions = $user->getDirectPermissions()->pluck('name')->toArray())
                            @php ($user_roles = $user->getPermissionsViaRoles()->pluck('name')->toArray())
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('', $permission->name, in_array($permission->name, $user_roles), ['disabled']) !!}
                                                {!! $permission->name !!}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', $permission->name, old('permissions[]', in_array($permission->name, $user_permissions))) !!}
                                                {!! $permission->name !!}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        No data
                    @endif
                </div>
            </div>
        </div>
    @endcan
</div>

@if ($user->id)
    {!! Form::submit('Update', ['class' => 'btn btn-default', 'name' => 'update']) !!}
@else
    {!! Form::submit('Create', ['class' => 'btn btn-default', 'name' => 'create']) !!}
@endif
{!! Form::close() !!}
