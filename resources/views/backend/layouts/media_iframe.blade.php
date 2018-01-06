<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Styles -->
    <link href="{{ asset('css/backend-app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="hold-transition pjax-container sidebar-mini skin-purple">
    @hasSection('content_header')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('content_header')
                <small>@yield('content_header_small')</small>
            </h1>
            @yield('breadcrumb')
        </section>
    @endif

    <!-- Main content -->
    <section class="content">
        @include('flash::message')
        @yield('content')
    </section>
    <!-- /.content -->

    <!-- Scripts -->
    <script src="{{ asset('js/backend-app.js') }}"></script>
    @include('backend.media._media_iframe_js')
    @stack('scripts')
</body>
</html>
