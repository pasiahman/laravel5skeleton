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
            <div class="form-group">
                <label>@lang('validation.attributes.title') (*)</label>
                <input class="form-control" name="title" required type="text" value="{{ request()->old('title', $medium->title) }}" />
                <i class="text-danger">{{ $errors->first('title') }}</i>
            </div>
            <div class="form-group">
                <label>@lang('validation.attributes.name') (*)</label>
                <input class="form-control" name="name" readonly required type="text" value="{{ request()->old('name', $medium->name) }}" />
                <i class="text-danger">{{ $errors->first('name') }}</i>
            </div>
            <div class="form-group">
                <label>@lang('cms.caption')</label>
                <textarea class="form-control" name="excerpt" rows="3">{{ request()->old('excerpt', $medium->excerpt) }}</textarea>
                <i class="text-danger">{{ $errors->first('excerpt') }}</i>
            </div>
            <div class="form-group">
                <label>@lang('cms.description')</label>
                <textarea class="form-control" name="content" rows="3">{{ request()->old('content', $medium->content) }}</textarea>
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
                                        ({{ $attachment_metadata['size'] }} B)
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        <div class="box-footer">
            <input class="btn btn-default" type="submit" value="@lang('cms.save')" />
        </div>
    </div>
</form>
