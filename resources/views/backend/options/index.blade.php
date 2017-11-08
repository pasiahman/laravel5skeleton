@extends('backend.layouts.main')

@section('title', __('cms.options'))
@section('content_header', __('cms.options'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-sliders"></i> @lang('cms.options')</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <a class="btn btn-default" href="{{ route('backendOptionCreate') }}">@lang('cms.create')</a>
        </div>
        <div class="box-body table-responsive">
            {!! Form::open(['method' => 'GET', 'route' => 'backendOptions']) !!}
            <table class="table table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th class="text-right" colspan="4">
                            <div class="form-inline">
                                <div class="form-group">
                                    @lang('cms.per_page')
                                    @php ($limitOptions = ['10' => '10', '25' => '25', '50' => '50', '100' => '100'])
                                    {!! Form::select('limit', $limitOptions, $request->query('limit'), ['class' => 'input-sm']) !!}

                                    @lang('cms.sort')
                                    @php ($sortOptions = ['name,ASC' => __('validation.attributes.name').' (A-Z)', 'name,DESC' => __('validation.attributes.name').' (Z-A)', 'value,ASC' => __('validation.attributes.value').' (A-Z)', 'value,DESC' => __('validation.attributes.value').' (Z-A)'])
                                    {!! Form::select('sort', $sortOptions, $request->query('sort'), ['class' => 'input-sm']) !!}
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>@lang('validation.attributes.name') {{ Form::text('name', $request->query('name'), ['class' => 'form-control input-sm']) }}</th>
                        <th>@lang('validation.attributes.value') {{ Form::text('value', $request->query('value'), ['class' => 'form-control input-sm']) }}</th>
                        <th>@lang('cms.action') <button class="btn btn-block btn-default btn-sm" type="submit"><i class="fa fa-search"></i></button></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($options as $i => $option)
                        <tr>
                            <td align="center">{{ ($options->currentPage() - 1) * $options->perPage() + $i + 1 }}</td>
                            <td>{{ $option->name }}</td>
                            <td>{{ $option->value }}</td>
                            <td align="center">
                                <a class="btn btn-primary btn-xs" href="{{ route('backendOptionUpdate', ['id' => $option->id]) }}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger btn-xs" href="{{ route('backendOptionDelete', $option->id) }}" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td align="center" colspan="4">@lang('cms.no_data')</td></tr>
                    @endforelse
                </tbody>
                <tfoot><tr><td align="center" colspan="4">{!! $options->appends($request->query())->links('vendor.pagination.default-pjax') !!}</td></tr></tfoot>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
