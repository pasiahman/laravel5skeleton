@if ($category->id)
    <form action="{{ route('backendCategoryUpdate', ['id' => $category->id]) }}" method="post">
        <input name="id" type="hidden" value="{{ $category->id }}" />
@else
    <form action="{{ route('backendCategoryCreate') }}" method="post">
@endif

    {{ csrf_field() }}
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <input name="locale" type="hidden" value="{{ request()->input('locale', config('app.locale')) }}" />
                    @foreach (config('app.languages') as $languageCode => $languageName)
                        @if ($category->id)
                            <a href="{{ route('backendCategoryUpdate', ['id' => $category->id, 'locale' => $languageCode]) }}">
                        @else
                            <a href="{{ route('backendCategoryCreate', ['locale' => $languageCode]) }}">
                        @endif

                            <img src="{{ asset('images/flags/'.$languageCode.'.gif') }}" />
                        </a>
                        {{ $languageCode == request()->input('locale', config('app.locale')) ? $languageName : '' }}
                    @endforeach
                    <hr />
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label>@lang('validation.attributes.name') (*)</label>
                        <input class="form-control" name="name" type="text" value="{{ request()->input('name', $category_translation->name) }}" />
                        <i class="text-danger">{{ $errors->first('name') }}</i>
                    </div>
                    <div class="form-group">
                        <label>@lang('validation.attributes.slug')</label>
                        <input class="form-control" readonly type="text" value="{{ request()->input('slug', $category_translation->slug) }}" />
                        <i class="text-danger">{{ $errors->first('slug') }}</i>
                    </div>
                    <div class="form-group">
                        <label>@lang('validation.attributes.description')</label>
                        <textarea class="form-control" name="description" rows="3">{{ request()->input('description', $category_translation->description) }}</textarea>
                        <i class="text-danger">{{ $errors->first('description') }}</i>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>@lang('validation.attributes.parent')</label>
                        <select class="form-control" name="parent_id">
                            <option value="0"></option>
                            @foreach ($parent_options as $id => $parent)
                                <option {{ $id == $category->id ? 'disabled' : '' }} {{ $id == request()->input('parent_id', $category->parent_id) ? 'selected' : '' }} value="{{ $id }}">{{ $parent }}</option>
                            @endforeach
                        </select>
                        <i class="text-danger">{{ $errors->first('parent_id') }}</i>
                    </div>
                </div>
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
