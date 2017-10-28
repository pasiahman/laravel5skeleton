@extends('backend.layouts.main')

@section('title', 'Update Permission')

@section('content')
    @include('backend.permissions._form', ['permission' => $permission])
@endsection('content')
