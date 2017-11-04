@extends('backend.layouts.main')

@section('title', 'Create Option')
@section('content_header', 'Create Option')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('backendOptions') }}"><i class="fa fa-sliders"></i>Options</a></li>
        <li class="active">Create</li>
    </ol>
@endsection

@section('content')
    @include('backend.options._form', ['option' => $option])
@endsection
