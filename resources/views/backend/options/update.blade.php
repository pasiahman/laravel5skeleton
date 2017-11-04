@extends('backend.layouts.main')

@section('title', 'Update Option')
@section('content_header', 'Update Option')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backendOptions') }}"><i class="fa fa-sliders"></i>Options</a></li>
        <li class="active">Update</li>
    </ol>
@endsection

@section('content')
    @include('backend.options._form', ['option' => $option])
@endsection
