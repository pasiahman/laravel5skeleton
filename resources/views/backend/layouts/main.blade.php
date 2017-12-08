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
    <header class="main-header">
        <!-- Logo -->
        <a class="logo" href="{{ route('backend') }}">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">{{ config('app.name', 'Laravel')[0] }}</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        @php ($languages = config('app.languages'))
                        @php ($locale = config('app.locale'))
                        <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                            <img src="{{ asset('images/flags/'.$locale.'.gif') }}" /> <span class="caret"></span>
                        </a>
                        @if ($languages)
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($languages as $languageCode => $languageName)
                                    <li>
                                        <a href="{{ route('locale.setlocale', $languageCode) }}" class="language"><img src="{{ asset('images/flags/'.$languageCode.'.gif') }}" /> {{ $languageName }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{-- <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> need Jovi --}}
                            {{-- <span class="hidden-xs">{{ Auth::user()->name }}</span> --}}
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                {{-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> need Jovi--}}

                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ Auth::user()->email }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            @lang('cms.logout')
                                        </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                        <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                    </ul>
                </li>
                {{-- <li class="header">@lang('cms.posts')</li> --}}
                <li><a href="{{ route('backendCategories') }}"><i class="fa fa-circle-o"></i> <span>@lang('cms.categories')</span></a></li>
                <li><a href="{{ route('backendMedia') }}"><i class="fa fa-upload"></i> <span>@lang('cms.media')</span></a></li>

                <li class="header">Masters</li>
                <li><a href="{{ route('backendPermissions') }}"><i class="fa fa-ban"></i> <span>@lang('cms.permissions')</span></a></li>
                <li><a href="{{ route('backendRoles') }}"><i class="fa fa-user"></i> <span>@lang('cms.roles')</span></a></li>
                <li><a href="{{ route('backendUsers') }}"><i class="fa fa-users"></i> <span>@lang('cms.users')</span></a></li>
                <li><a href="{{ route('backendOptions') }}"><i class="fa fa-sliders"></i> <span>@lang('cms.options')</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
    </div>
    <!-- /.content-wrapper -->

    <!-- Scripts -->
    <script src="{{ asset('js/backend-app.js') }}"></script>
    @stack('scripts')
</body>
</html>
