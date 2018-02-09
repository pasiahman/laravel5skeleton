@if ($medium->id)
    <form action="{{ route('backend.media.update', $medium->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $medium->id }}" />
@else
    <form action="{{ route('backend.media.store') }}" method="post">
@endif

    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-body">
                    <input name="locale" type="hidden" value="{{ request()->old('locale', request()->query('locale', config('app.locale'))) }}" />
                    @foreach (config('app.languages') as $languageCode => $languageName)
                        @if ($medium->id)
                            @php $languageHref = route('backend.media.edit', ['id' => $medium->id, 'locale' => $languageCode]) @endphp
                        @else
                            @php $languageHref = route('backend.media.create', ['locale' => $languageCode]) @endphp
                        @endif

                        <a href="{{ $languageHref }}">
                            <img src="{{ asset('images/flags/'.$languageCode.'.gif') }}" />
                        </a>
                        {{ $languageCode == request()->old('locale', request()->query('locale', config('app.locale'))) ? $languageName : '' }}
                    @endforeach
                    <hr />
                    <div class="form-group">
                        <label>@lang('validation.attributes.title') (*)</label>
                        <input class="form-control input-sm" name="title" required type="text" value="{{ request()->old('title', $medium_translation->title) }}" />
                        <i class="text-danger">{{ $errors->first('title') }}</i>
                    </div>
                    <div class="form-group">
                        <label>@lang('validation.attributes.name') (*)</label>
                        <input class="form-control input-sm" name="name" readonly required type="text" value="{{ request()->old('name', $medium_translation->name) }}" />
                        <i class="text-danger">{{ $errors->first('name') }}</i>
                    </div>
                    <div class="form-group">
                        <label>@lang('cms.caption')</label>
                        <textarea class="form-control input-sm" name="excerpt" rows="3">{{ request()->old('excerpt', $medium_translation->excerpt) }}</textarea>
                        <i class="text-danger">{{ $errors->first('excerpt') }}</i>
                    </div>
                    <div class="form-group">
                        <label>@lang('cms.description')</label>
                        <textarea class="form-control input-sm" name="content" rows="3">{{ request()->old('content', $medium_translation->content) }}</textarea>
                        <i class="text-danger">{{ $errors->first('content') }}</i>
                    </div>
                    @if ($medium->id)
                        @php
                        $attached_file = $medium->postmetas->where('key', 'attached_file')->first()->value;
                        $attached_file_thumbnail = $medium->postmetas->where('key', 'attached_file_thumbnail')->first()->value;
                        $attachment_metadata = json_decode($medium->postmetas->where('key', 'attachment_metadata')->first()->value, true);
                        @endphp

                        <div class="row">
                            <div class="col-md-4">
                                <input name="postmetas[attached_file]" type="hidden" value="{{ $attached_file }}" />
                                <input name="postmetas[attached_file_thumbnail]" type="hidden" value="{{ $attached_file_thumbnail }}" />
                                <input name="postmetas[attachment_metadata]" type="hidden" value="{{ json_encode($attachment_metadata) }}" />
                                <a
                                    @if (in_array($medium->mime_type, $medium->mimeTypeImages)) data-fancybox="group" @endif
                                    href="{{ Storage::url($attached_file) }}" target="_blank"
                                >
                                    <img class="media-object" src="{{ Storage::url($attached_file_thumbnail) }}" style="height: 150px; width: 150px;" />
                                </a>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-condensed">
                                    <tbody>
                                        <tr>
                                            <td width="20%">@lang('cms.file_url')</td>
                                            <td width="1%">:</td>
                                            <td>{{ $attached_file }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('cms.file_type')</td>
                                            <td>:</td>
                                            <td>{{ $medium->mime_type }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('cms.extension')</td>
                                            <td>:</td>
                                            <td>{{ $attachment_metadata['extension'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('cms.file_size')</td>
                                            <td>:</td>
                                            <td>
                                                {{ Conversion::convert($attachment_metadata['size'], 'byte')->to('megabyte') }} MB
                                                ({{ number_format($attachment_metadata['size']) }} B)
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label>@lang('validation.attributes.status')</label>
                        <select class="form-control input-sm" name="status">
                            @foreach (collect($medium->getStatusOptions())->except('draft') as $optionValue => $optionName)
                                <option
                                    {{ 'trash' == request()->old('status', $medium->status) ? 'selected' : '' }}
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
                        $categories = $medium->id && isset($medium->postmetas->where('key', 'categories')->first()->value) ? json_decode($medium->postmetas->where('key', 'categories')->first()->value, true) : $categories;
                        $categories = is_array(request()->old('postmetas.categories')) ? request()->old('postmetas.categories') : $categories;
                        @endphp

                        @foreach ($medium->getCategoriesTree() as $category_tree)
                            <div class="checkbox">
                                {{ $category_tree['tree_prefix'] }}
                                <label>
                                    <input name="postmetas[categories][]" {{ in_array($category_tree['id'], $categories) ? 'checked' : '' }} type="checkbox" value="{{ $category_tree['id'] }}" /> {{ $category_tree['name'] }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('cms.tags')</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    @php
                    $tags = [];
                    $tags = $medium->id && isset($medium->postmetas->where('key', 'tags')->first()->value) ? json_decode($medium->postmetas->where('key', 'tags')->first()->value, true) : $tags;
                    $tags = is_array(request()->old('postmetas.tags')) ? request()->old('postmetas.tags') : $tags;
                    @endphp

                    <select class="form-control input-sm select2" multiple="multiple" name="postmetas[tags][]">
                        @foreach ($medium->getTagOptions() as $tagId => $tagName)
                            <option {{ in_array($tagId, $tags) ? 'selected' : '' }} value="{{ $tagId }}">{{ $tagName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>
