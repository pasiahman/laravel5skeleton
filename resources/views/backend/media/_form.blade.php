@if ($medium->id)
    <form action="{{ route('backend.media.update', $medium->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $medium->id }}" />
@else
    <form action="{{ route('backend.media.store') }}" method="post">
@endif

    {{ csrf_field() }}
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
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
                        @php ($attached_file = $medium->postmetas->where('key', 'attached_file')->first()->value)
                        @php ($attached_file_thumbnail = $medium->postmetas->where('key', 'attached_file_thumbnail')->first()->value)
                        @php ($attachment_metadata = json_decode($medium->postmetas->where('key', 'attachment_metadata')->first()->value, true))

                        <div class="row">
                            <div class="col-md-4">
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
            </div>
        </div>
        <div class="box-footer">
            <input class="btn btn-default btn-sm" type="submit" value="@lang('cms.save')" />
        </div>
    </div>
</form>
