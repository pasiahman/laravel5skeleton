@if ($category->id)
    <form action="{{ route('backendCategoryUpdate', ['id' => $category->id]) }}" method="post">
        <input name="id" type="hidden" value="{{ $category->id }}" />
@else
    <form action="{{ route('backendCategoryCreate') }}" method="post">
@endif

    {{ csrf_field() }}
    <div class="box">
        <div class="box-body">
            <div class="form-group">
                <label>@lang('validation.attributes.name') (*)</label>
                <input class="form-control" name="name" required type="text" value="{{ request()->input('name', $category->name) }}" />
                <i class="text-danger">{{ $errors->first('name') }}</i>
            </div>
            <div class="form-group">
                <label>@lang('validation.attributes.slug')</label>
                <input class="form-control" readonly type="text" value="{{ request()->input('slug', $category->slug) }}" />
                <i class="text-danger">{{ $errors->first('slug') }}</i>
            </div>
            <div class="form-group">
                <label>@lang('validation.attributes.parent')</label>
                <select class="form-control" name="parent_id">
                    <option value="0"></option>
                    @foreach ($parent_options as $id => $parent)
                        <option {{ $category->id == $id ? 'disabled' : '' }} {{ request()->input('parent_id', $category->id) == $id ? 'selected' : '' }} value="{{ $id }}">{{ $parent }}</option>
                    @endforeach
                </select>
                <i class="text-danger">{{ $errors->first('parent_id') }}</i>
            </div>
            <div class="form-group">
                <label>@lang('validation.attributes.description')</label>
                <textarea class="form-control" name="description" rows="3">{{ request()->input('description', $category->description) }}</textarea>
                <i class="text-danger">{{ $errors->first('description') }}</i>
            </div>
        </div>
        <div class="box-footer">
            @if ($category->id)
                <input class="btn btn-default" name="update" type="submit" value="@lang('cms.update')" />
            @else
                <input class="btn btn-default" name="create" type="submit" value="@lang('cms.create')" />
            @endif
        </div>
    </div>
</form>
