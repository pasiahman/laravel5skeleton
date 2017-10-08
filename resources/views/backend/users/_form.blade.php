@if ($user->id)
    {!! Form::model($user, ['method' => 'put', 'route' => ['backendUserUpdate']]) !!}
    {!! Form::hidden('id', $user->id) !!}
@else
    {!! Form::model($user, ['route' => 'backendUserCreate']) !!}
@endif

<div class="form-group">
    {!! Form::label('name') !!}
    {!! Form::text('name', old('name', $user->name), ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('email') !!}
    {!! Form::email('email', old('name', $user->email), ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('password') !!}
    {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
</div>

@if ($user->id)
    {!! Form::submit('Update', ['class' => 'btn btn-default', 'name' => 'update']) !!}
@else
    {!! Form::submit('Create', ['class' => 'btn btn-default', 'name' => 'create']) !!}
@endif
{!! Form::close() !!}
