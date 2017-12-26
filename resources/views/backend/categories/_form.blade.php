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
                        <input class="form-control" name="name" type="text" value="{{ request()->old('name', $category_translation->name) }}" />
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
                    <div class="form-group">
                        <label>@lang('cms.images')</label>
                        <u>
                            <a
                                data-fancybox
                                data-type="iframe"
                                href="{{ route('backend.media.index', ['fancybox_to' => 'images', 'layout' => 'media_iframe']) }}"
                            >@lang('cms.choose')</a>
                        </u>
                        <ul class="list-inline sortable-list-group" id="images">
                            <template class="hidden" id="images_template">
                                <li>
                                    <input class="images_media_id" name="termmeta[images][]" type="hidden" value="$images_media_id" />
                                    <div style="position: relative;">
                                        <a class="images_media_attached_file" data-fancybox="group" href="$images_media_attached_file" target="_blank">
                                            <img class="images_media_attached_file_thumbnail media-object" src="$images_media_attached_file_thumbnail" style="height: 64px; width: 64px;" />
                                        </a>
                                        <button class="close template_close" type="button"><span>&times;</span></button>
                                    </div>
                                </li>
                            </template>

                            @php
                                $images = [];
                                $images = $category->id && isset($category->termmetas->where('key', 'images')->first()->value) ? json_decode($category->termmetas->where('key', 'images')->first()->value, true) : $images;
                                $images = is_array(request()->old('termmeta.images')) ? request()->old('termmeta.images') : $images;
                            @endphp

                            @foreach ($images as $imageId)
                                @php
                                    $medium = \App\Http\Models\Media::find($imageId);
                                    $attached_file = $medium->postmetas->where('key', 'attached_file')->first()->value;
                                    $attached_file_thumbnail = $medium->postmetas->where('key', 'attached_file_thumbnail')->first()->value;
                                @endphp

                                <li>
                                    <input class="images_media_id" name="termmeta[images][]" type="hidden" value="{{ $imageId }}" />
                                    <div style="position: relative;">
                                        <a class="images_media_attached_file" data-fancybox="group" href="{{ Storage::url($attached_file) }}" target="_blank">
                                            <img class="images_media_attached_file_thumbnail media-object" src="{{ Storage::url($attached_file_thumbnail) }}" style="height: 64px; width: 64px;" />
                                        </a>
                                        <button class="close template_close" type="button"><span>&times;</span></button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <input class="btn btn-default" type="submit" value="@lang('cms.save')" />
        </div>
    </div>
</form>
