@if ($medium->id)
    {{ Form::model($medium, ['method' => 'put', 'route' => ['backendMediumUpdate']]) }}
    {{ Form::hidden('id', $medium->id) }}
@else
    {{ Form::model($medium, ['route' => 'backendMediumCreate']) }}
@endif
<div class="box">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label(__('validation.attributes.title').' (*)') }}
            {{ Form::text('title', old('title', $medium->title), ['class' => 'form-control', 'required']) }}
            <i class="text-danger">{{ $errors->first('title') }}</i>
        </div>
        <div class="form-group">
            {{ Form::label(__('validation.attributes.name').' (*)') }}
            {{ Form::text('name', old('title', $medium->name), ['class' => 'form-control', 'readonly', 'required']) }}
            <i class="text-danger">{{ $errors->first('name') }}</i>
        </div>
        <div class="form-group">
            {{ Form::label(__('cms.caption')) }}
            {{ Form::textarea('excerpt', old('excerpt', $medium->excerpt), ['class' => 'form-control', 'rows' => 3]) }}
            <i class="text-danger">{{ $errors->first('excerpt') }}</i>
        </div>
        <div class="form-group">
            {{ Form::label(__('cms.description')) }}
            {{ Form::textarea('content', old('content', $medium->content), ['class' => 'form-control', 'rows' => 3]) }}
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
        @if ($medium->id)
            <input class="btn btn-default" name="update" type="submit" value="@lang('cms.update')" />
        @else
            <input class="btn btn-default" name="create" type="submit" value="@lang('cms.create')" />
        @endif
    </div>
</div>
{{ Form::close() }}
