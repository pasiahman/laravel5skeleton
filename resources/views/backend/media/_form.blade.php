@if ($medium->id)
    {!! Form::model($medium, ['method' => 'put', 'route' => ['backendMediumUpdate']]) !!}
    {!! Form::hidden('id', $medium->id) !!}
@else
    {!! Form::model($medium, ['route' => 'backendMediumCreate']) !!}
@endif
<div class="box">
    <div class="box-body">
        <div class="form-group">
            {!! Form::label(__('validation.attributes.name').' (*)') !!}
            {!! Form::text('name', old('name', $medium->name), ['class' => 'form-control', 'required']) !!}
            <i class="text-danger">{{ $errors->first('name') }}</i>
        </div>
        <div class="form-group">
            {!! Form::label(__('validation.attributes.value')) !!}
            {!! Form::textarea('value', old('value', $medium->value), ['class' => 'form-control', 'rows' => 3]) !!}
            <i class="text-danger">{{ $errors->first('value') }}</i>
        </div>
        <div id="fine-uploader-gallery"></div>
    </div>
    <div class="box-footer">
        @if ($medium->id)
            <input class="btn btn-default" name="update" type="submit" value="@lang('cms.update')" />
        @else
            <input class="btn btn-default" name="create" type="submit" value="@lang('cms.create')" />
        @endif
    </div>
</div>
{!! Form::close() !!}

@include('vendor/fine-uploader/gallery')
@include('backend/media/_form_js')
