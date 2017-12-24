@if ($option->id)
    <form action="{{ route('backend.options.update', $option->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $option->id }}" />
@else
    <form action="{{ route('backend.options.store') }}" method="post">
@endif

    {{ csrf_field() }}
    <div class="box">
        <div class="box-body">
            <div class="form-group">
                <label>@lang('validation.attributes.name') (*)</label>
                <input class="form-control" name="name" type="text" value="{{ request()->old('name', $option->name) }}" />
                <i class="text-danger">{{ $errors->first('name') }}</i>
            </div>
            <div class="form-group">
                <label>@lang('validation.attributes.value')</label>
                <textarea class="form-control" name="value" rows="3">{{ request()->old('value', $option->value) }}</textarea>
                <i class="text-danger">{{ $errors->first('value') }}</i>
            </div>
        </div>
        <div class="box-footer">
            <input class="btn btn-default" type="submit" value="@lang('cms.save')" />
        </div>
    </div>
</form>
