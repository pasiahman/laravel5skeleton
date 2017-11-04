@extends('backend.layouts.main')

@section('title', 'Options')
@section('content_header', 'Options')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-sliders"></i> Options</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <a class="btn btn-default" href="{{ route('backendOptionCreate') }}">Create</a>
        </div>
        <div class="box-body table-responsive">
            {!! Form::open(['method' => 'GET', 'route' => 'backendOptions']) !!}
            <table class="table table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th class="text-right" colspan="4">
                            <div class="form-inline">
                                <div class="form-group">
                                    Per page
                                    @php ($limitOptions = ['10' => '10', '25' => '25', '50' => '50', '100' => '100'])
                                    {!! Form::select('limit', $limitOptions, $request->query('limit'), ['class' => 'input-sm']) !!}

                                    Sort
                                    @php ($sortOptions = ['name,ASC' => 'Name (A-Z)', 'name,DESC' => 'Name (Z-A)', 'value,ASC' => 'Value (A-Z)', 'value,DESC' => 'Value (Z-A)'])
                                    {!! Form::select('sort', $sortOptions, $request->query('sort'), ['class' => 'input-sm']) !!}
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Name {{ Form::text('name', $request->query('name'), ['class' => 'form-control input-sm']) }}</th>
                        <th>Value {{ Form::text('value', $request->query('value'), ['class' => 'form-control input-sm']) }}</th>
                        <th>Action <button class="btn btn-block btn-default btn-sm" type="submit"><i class="fa fa-search"></i></button></th>
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
                        <tr><td align="center" colspan="4">No data</td></tr>
                    @endforelse
                </tbody>
                <tfoot><tr><td align="center" colspan="4">{!! $options->appends($request->query())->links('vendor.pagination.default-pjax') !!}</td></tr></tfoot>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
