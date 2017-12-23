@if ($category->id)
    <form action="{{ route('backend.categories.update', $category->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $category->id }}" />
@else
    <form action="{{ route('backend.categories.store') }}" method="post">
@endif

    {{ csrf_field() }}
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <input name="locale" type="hidden" value="{{ request()->old('locale', request()->query('locale', config('app.locale'))) }}" />
                    @foreach (config('app.languages') as $languageCode => $languageName)
                        @if ($category->id)
                            <a href="{{ route('backend.categories.edit', ['id' => $category->id, 'locale' => $languageCode]) }}">
                        @else
                            <a href="{{ route('backend.categories.create', ['locale' => $languageCode]) }}">
                        @endif

                            <img src="{{ asset('images/flags/'.$languageCode.'.gif') }}" />
                        </a>
                        {{ $languageCode == request()->old('locale', request()->query('locale', config('app.locale'))) ? $languageName : '' }}
                    @endforeach
                    <hr />
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label>@lang('validation.attributes.name') (*)</label>
                        <input class="form-control" name="name" required type="text" value="{{ request()->old('name', $category_translation->name) }}" />
                        <i class="text-danger">{{ $errors->first('name') }}</i>
                    </div>
                    <div class="form-group">
                        <label>@lang('validation.attributes.slug')</label>
                        <input class="form-control" readonly type="text" value="{{ request()->old('slug', $category_translation->slug) }}" />
                        <i class="text-danger">{{ $errors->first('slug') }}</i>
                    </div>
                    <div class="form-group">
                        <label>@lang('validation.attributes.description')</label>
                        <textarea class="form-control" name="description" rows="3">{{ request()->old('description', $category_translation->description) }}</textarea>
                        <i class="text-danger">{{ $errors->first('description') }}</i>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>@lang('validation.attributes.parent')</label>
                        <select class="form-control" name="parent_id">
                            <option value="0"></option>
                            @foreach ($parent_options as $id => $parent)
                                <option {{ $id == $category->id ? 'disabled' : '' }} {{ $id == request()->old('parent_id', $category->parent_id) ? 'selected' : '' }} value="{{ $id }}">{{ $parent }}</option>
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
