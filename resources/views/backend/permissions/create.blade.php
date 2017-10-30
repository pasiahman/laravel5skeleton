@extends('backend.layouts.main')

@section('title', 'Create Permission')

@section('content')
    @include('backend.permissions._form', ['permission' => $permission])
@endsection
