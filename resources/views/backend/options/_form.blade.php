{{ csrf_field() }}
<div class="box">
    <div class="box-body">
        <div class="form-group">
            <label>@lang('validation.attributes.name') (*)</label>
            <input class="form-control input-sm" name="name" required type="text" value="{{ request()->old('name', $option->name) }}" />
            <i class="text-danger">{{ $errors->first('name') }}</i>
        </div>
        <div class="form-group">
            <label>@lang('validation.attributes.value')</label>
            <textarea class="form-control input-sm" name="value" rows="3">{{ request()->old('value', $option->value) }}</textarea>
            <i class="text-danger">{{ $errors->first('value') }}</i>
        </div>
    </div>
    <div class="box-footer">
        <input class="btn btn-default btn-sm" type="submit" value="@lang('cms.save')" />
    </div>
</div>
