@if ($permission->id)
    <form action="{{ route('backend.permissions.update', $permission->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $permission->id }}" />
@else
    <form action="{{ route('backend.permissions.store') }}" method="post">
@endif

    {{ csrf_field() }}
    <div class="box">
        <div class="box-body">
            <div class="form-group">
                <label>@lang('validation.attributes.name') (*)</label>
                <input class="form-control" name="name" required type="text" value="{{ request()->old('name', $permission->name) }}" />
                <i class="text-danger">{{ $errors->first('name') }}</i>
            </div>
            <div class="form-group">
                <label>@lang('validation.attributes.guard_name') (*)</label>
                <input class="form-control" name="guard_name" readonly required type="text" value="{{ request()->old('guard_name', $permission->guard_name) }}" />
                <i class="text-danger">{{ $errors->first('guard_name') }}</i>
            </div>
        </div>
        <div class="box-footer">
            <input class="btn btn-default" type="submit" value="@lang('cms.save')" />
        </div>
    </div>
</form>
