@if ($post->id)
    <form action="{{ route('backend.posts.update', $post->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $post->id }}" />
@else
    <form action="{{ route('backend.posts.store') }}" method="post">
@endif

    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-body">
                    <input name="locale" type="hidden" value="{{ request()->old('locale', request()->query('locale', config('app.locale'))) }}" />
                    @foreach (config('app.languages') as $languageCode => $languageName)
                        @if ($post->id)
                            @php $languageHref = route('backend.posts.edit', ['id' => $post->id, 'locale' => $languageCode]) @endphp
                        @else
                            @php $languageHref = route('backend.posts.create', ['locale' => $languageCode]) @endphp
                        @endif

                        <a href="{{ $languageHref }}">
                            <img src="{{ asset('images/flags/'.$languageCode.'.gif') }}" />
                        </a>
                        {{ $languageCode == request()->old('locale', request()->query('locale', config('app.locale'))) ? $languageName : '' }}
                    @endforeach
                    <hr />
                    <div class="form-group">
                        <label>@lang('validation.attributes.title') (*)</label>
                        <input class="form-control" maxlength=200 name="title" required type="text" value="{{ request()->old('title', $post_translation->title) }}" />
                        <i class="text-danger">{{ $errors->first('title') }}</i>
                    </div>
                    <div class="form-group">
                        <label>@lang('validation.attributes.slug')</label>
                        <input class="form-control" readonly type="name" value="{{ request()->old('name', $post_translation->name) }}" />
                        <i class="text-danger">{{ $errors->first('name') }}</i>
                    </div>
                    <div class="form-group">
                        <label>@lang('validation.attributes.excerpt')</label>
                        <textarea class="form-control" name="excerpt" rows="3">{{ request()->old('excerpt', $post_translation->excerpt) }}</textarea>
                        <i class="text-danger">{{ $errors->first('excerpt') }}</i>
                    </div>
                    <div class="form-group">
                        <label>@lang('validation.attributes.content')</label>
                        <textarea class="form-control" name="content" rows="6">{{ request()->old('content', $post_translation->content) }}</textarea>
                        <i class="text-danger">{{ $errors->first('content') }}</i>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label>@lang('validation.attributes.status')</label>
                        <select class="form-control input-sm" name="status">
                            @foreach ($post->getStatusOptions() as $optionValue => $optionName)
                                <option
                                    @if (isset($post->id) === false && $optionValue == 'trash') hidden @endif
                                    {{ $optionValue == request()->old('status', $post->status) ? 'selected' : '' }}
                                    value="{{ $optionValue }}"
                                >{{ $optionName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-default btn-sm" type="submit" value="@lang('cms.save')" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('cms.images')</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <u>
                        <a
                        data-fancybox
                        data-type="iframe"
                        href="{{ route('backend.media.index', ['fancybox_to' => 'images', 'layout' => 'media_iframe', 'mime_type_like' => 'image/']) }}"
                        >@lang('cms.choose')</a>
                    </u>
                    <ul class="list-inline sortable-list-group" id="images">
                        <template class="hidden" id="images_template">
                            <li>
                                <input class="images_media_id" name="postmeta[images][]" type="hidden" value="$images_media_id" />
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
                        $images = $post->id && isset($post->postmetas->where('key', 'images')->first()->value) ? json_decode($post->postmetas->where('key', 'images')->first()->value, true) : $images;
                        $images = is_array(request()->old('postmeta.images')) ? request()->old('postmeta.images') : $images;
                        @endphp

                        @foreach ($images as $imageId)
                            @php
                            $medium = \App\Http\Models\Media::find($imageId);
                            $attached_file = $medium ? $medium->postmetas->where('key', 'attached_file')->first()->value : '';
                            $attached_file_thumbnail = $medium ? $medium->postmetas->where('key', 'attached_file_thumbnail')->first()->value : '';
                            @endphp

                            <li>
                                <input class="images_media_id" name="postmeta[images][]" type="hidden" value="{{ $imageId }}" />
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
        <div class="col-md-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('cms.categories')</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="categories-container">
                        @php
                        $categories = [];
                        $categories = $post->id && isset($post->postmetas->where('key', 'categories')->first()->value) ? json_decode($post->postmetas->where('key', 'categories')->first()->value, true) : $categories;
                        $categories = is_array(request()->old('postmeta.categories')) ? request()->old('postmeta.categories') : $categories;
                        @endphp

                        @foreach ($post->getCategoriesTree() as $category_tree)
                            <div class="checkbox">
                                {{ $category_tree['tree_prefix'] }}
                                <label>
                                    <input name="postmeta[categories][]" {{ in_array($category_tree['id'], $categories) ? 'checked' : '' }} type="checkbox" value="{{ $category_tree['id'] }}" /> {{ $category_tree['name'] }}
                                </label>
                            </div>
                        @endforeach
                        <i class="text-danger">{{ $errors->first('parent_id') }}</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
