<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="{{ asset('favicon1.png') }}">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('themes/back/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('themes/back/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('themes/back/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/back/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/back/css/skins/_all-skins.min.css') }}">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    @yield('additionalCSS')

    <!-- HTML5 Shim and Respond.js for IE8 support -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .img-thumbnail { background-color: #fff !important; }
        .block__list { padding: 0; width: 100%; }
        .block__list li { width: 9.8%; list-style: none; cursor: move; }
        @media (max-width: 767px) { .block__list li { width: 49%; } }
        .block__list_tags li { display: inline-block; text-align: center; }
        .btnRemoveImage { color: red !important; cursor: pointer !important; }
        .block__list img { height: 100px; }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <a href="{{ route('admin.dashboard') }}" class="logo">
            <span class="logo-mini">{{ config('app.name', 'Laravel') }}</span>
            <span class="logo-lg"><b>{{ config('app.name', 'Laravel') }}</b></span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('themes/back/img/avatar.png') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>

                <li class="{{ Route::currentRouteName() == 'all_about' ? 'active' : '' }}">
                    <a href="{{ route('admin.all_about') }}"><i class="fa fa-circle-o text-red"></i> About us</a>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['admin.gallery-images.index','admin.gallery-image.add','admin.gallery-image.edit']) ? 'active' : '' }}">
                    <a href="{{ route('admin.gallery-images.index') }}"><i class="fa fa-circle-o text-red"></i> Gallery</a>
                </li>

                <li class="treeview {{ in_array(Route::currentRouteName(), ['admin.brand','admin.brand.add','brand.addPost','brand.edit','brand.editPost','admin.product.category','admin.product.category.add','admin.product.category.edit','admin.products','admin.product.add','admin.product.edit']) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-red"></i> <span>Product Manage</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.brand') }}"><i class="fa fa-circle-o"></i> Brand</a></li>
                        <li><a href="{{ route('admin.product.category') }}"><i class="fa fa-circle-o"></i> Product Category</a></li>
                        <li><a href="{{ route('admin.products') }}"><i class="fa fa-circle-o"></i> Product</a></li>
                    </ul>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['admin.all_certificate', 'admin.add_certificate', 'admin.edit_certificate']) ? 'active' : '' }}">
                    <a href="{{ route('admin.all_certificate') }}"><i class="fa fa-circle-o text-red"></i> Membership & Certificate</a>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['admin.job.notice', 'admin.add.job.notice', 'admin.edit.job.notice']) ? 'active' : '' }}">
                    <a href="{{ route('admin.job.notice') }}"><i class="fa fa-circle-o text-red"></i> Job Notice</a>
                </li>

                <li class="{{ Route::currentRouteName() == 'admin.jobs' ? 'active' : '' }}">
                    <a href="{{ route('admin.jobs') }}"><i class="fa fa-circle-o text-red"></i> Job Apply List</a>
                </li>

                <li class="treeview {{ in_array(Route::currentRouteName(), ['admin.add.client.form','admin.all.client','admin.edit.client','admin.customer.category.add','admin.customer.category','admin.customer.category.edit']) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-red"></i> <span>Customer Manage</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.customer.category') }}"><i class="fa fa-circle-o"></i> Category</a></li>
                        <li><a href="{{ route('admin.all.client') }}"><i class="fa fa-circle-o"></i> Customer</a></li>
                    </ul>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['admin.news.add_news', 'admin.news.index', 'admin.news.edit_news']) ? 'active' : '' }}">
                    <a href="{{ route('admin.news.index') }}"><i class="fa fa-circle-o text-red"></i> News/Event</a>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['admin.add_team', 'admin.admin_all_team', 'admin.edit_team']) ? 'active' : '' }}">
                    <a href="{{ route('admin.admin_all_team') }}"><i class="fa fa-circle-o text-red"></i> Our Team</a>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['admin.add_client_testimonial', 'admin.admin_all_client_testimonial', 'admin.edit_client_testimonial']) ? 'active' : '' }}">
                    <a href="{{ route('admin.admin_all_client_testimonial') }}"><i class="fa fa-circle-o text-red"></i> Client Testimonial</a>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['admin.association_web_url', 'admin.association_web_url_add', 'admin.association_web_url_edit']) ? 'active' : '' }}">
                    <a href="{{ route('admin.association_web_url') }}"><i class="fa fa-circle-o text-red"></i> Association Web Link</a>
                </li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@yield('title')</h1>
        </section>
        <section class="content">
            @yield('content')
        </section>
    </div>

    <footer class="main-footer">
        <strong>Developed by <a target="_blank" href="https://github.com/mdrafiunislam17">MD RAFIUN ISLAM</a></strong>
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('themes/back/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('themes/back/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('themes/back/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('themes/back/js/adminlte.min.js') }}"></script>

<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>

@yield('additionalJS')

</body>
</html>
