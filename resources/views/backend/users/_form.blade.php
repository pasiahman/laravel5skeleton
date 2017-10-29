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

<div class="panel panel-default">
    <div class="panel-heading">Roles</div>
    <div class="panel-body" style="max-height: 300px; overflow: auto;">
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

@if ($user->id)
    {!! Form::submit('Update', ['class' => 'btn btn-default', 'name' => 'update']) !!}
@else
    {!! Form::submit('Create', ['class' => 'btn btn-default', 'name' => 'create']) !!}
@endif
{!! Form::close() !!}
