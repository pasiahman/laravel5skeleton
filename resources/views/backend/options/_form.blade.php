@if ($option->id)
    {!! Form::model($option, ['method' => 'put', 'route' => ['backendOptionUpdate']]) !!}
    {!! Form::hidden('id', $option->id) !!}
@else
    {!! Form::model($option, ['route' => 'backendOptionCreate']) !!}
@endif
<div class="box">
    <div class="box-body">
        <div class="form-group">
            {!! Form::label('name'.' (*)') !!}
            {!! Form::text('name', old('name', $option->name), ['class' => 'form-control', 'required']) !!}
            <i class="text-danger">{{ $errors->first('name') }}</i>
        </div>
        <div class="form-group">
            {!! Form::label('value') !!}
            {!! Form::textarea('value', old('value', $option->value), ['class' => 'form-control', 'rows' => 3]) !!}
            <i class="text-danger">{{ $errors->first('value') }}</i>
        </div>
    </div>
    <div class="box-footer">
        @if ($option->id)
            {!! Form::submit('Update', ['class' => 'btn btn-default', 'name' => 'update']) !!}
        @else
            {!! Form::submit('Create', ['class' => 'btn btn-default', 'name' => 'create']) !!}
        @endif
    </div>
</div>
{!! Form::close() !!}
