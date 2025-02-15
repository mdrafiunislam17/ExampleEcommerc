<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('favicon1.png')}}">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('themes/back/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('themes/back/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('themes/back/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/back/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('themes/back/css/skins/_all-skins.min.css') }}">
    @yield('additionalCSS')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        .img-thumbnail {
            background-color: #fff !important;
        }
        .block__list {
            padding: 0;
            width: 100%;
        }
        .block__list li {
            width: 9.8%;
            list-style: none;
            cursor: move;
        }
        @media (max-width: 767px) {
            .block__list li {
                width: 49%;
            }
        }
        .block__list_tags li {
            display: inline-block;
            text-align: center;
        }
        .btnRemoveImage {
            color: red !important;
            cursor: pointer !important;
        }

        .block__list img {
            height: 100px;
        }

    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo">Dashboard</a>

        <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">{{ config('app.name','Laravel') }}</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg" style="font-size: 15px;"><b>{{ config('app.name','Laravel') }}</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('themes/back/img/avatar.png') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>
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
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>


                  <li class="{{ Route::currentRouteName() == 'all_about' ? 'active' : '' }}">
                      <a href="{{ route('admin.all_about') }}"><i class="fa fa-circle-o text-red"></i>About us</a>
                 </li>
                <?php
                $subMenu = ['admin.gallery-images.index','admin.gallery-image.add','admin.gallery-image.edit'];
                ?>

                <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="{{ route('admin.gallery-images.index') }}"><i class="fa fa-circle-o text-red"></i>Gallery</a>
                </li>
                <?php
                $subMenu = ['admin.add_slider', 'admin.admin_all_slider', 'admin.edit_slider'];
                ?>

                <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="{{ route('admin.admin_all_slider') }}"><i class="fa fa-circle-o text-red"></i>Slider</a>
                </li>




                <?php
                $subMenu = ['admin.brand','admin.brand.add','brand.addPost','brand.edit','brand.editPost',
                    'admin.product.category', 'admin.product.category.add', 'admin.product.category.edit',
                    'admin.products','admin.product.add','admin.product.edit',];
                ?>

                <li class="treeview {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-red"></i> <span>Product Manage</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subMenu) ? 'active menu-open' : '' }}">

                        <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                            <a href="{{ route('admin.brand') }}"><i class="fa fa-circle-o text-red"></i>Brand</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'product.category' ? 'active' : '' }}">
                            <a href="{{ route('admin.product.category') }}"><i class="fa fa-circle-o"></i> product category</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'products' ? 'active' : '' }}">
                            <a href="{{ route('admin.products') }}"><i class="fa fa-circle-o"></i> Product</a>
                        </li>
                    </ul>
                </li>

                <?php
                $subMenu = ['admin.all_certificate', 'admin.add_certificate', 'admin.edit_certificate'];
                ?>

                <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="{{ route('admin.all_certificate') }}"><i class="fa fa-circle-o text-red"></i>MemberShip & Certificate</a>
                </li>

                <?php
                $subMenu = ['admin.job.notice', 'admin.add.job.notice', 'admin.edit.job.notice'];
                ?>

                <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="{{ route('admin.job.notice') }}"><i class="fa fa-circle-o text-red"></i> Job Notice</a>
                </li>
                <?php
                $subMenu = ['admin.job.apply.list'];
                ?>
                <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="{{ route('admin.job.apply.list') }}"><i class="fa fa-circle-o text-red"></i> Job Apply List</a>
                </li>
                <?php
                $subMenu = ['admin.add.client.form','admin.all.client','admin.edit.client','admin.customer.category.add','admin.customer.category','admin.customer.category.edit'];
                ?>
                <li class="treeview {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-red"></i> <span>Customer Manage</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subMenu) ? 'active menu-open' : '' }}">
                        <li class="{{ Route::currentRouteName() == 'admin.customer.category' ? 'active' : '' }}">
                            <a href="{{ route('admin.customer.category') }}"><i class="fa fa-circle-o"></i> Category</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'admin.all.client' ? 'active' : '' }}">
                            <a href="{{ route('admin.all.client') }}"><i class="fa fa-circle-o"></i> Customer</a>
                        </li>
                    </ul>
                </li>

            <?php
                    $subMenu = ['admin.news.add_news', 'admin.news.index', 'admin.news.edit_news'];
                ?>

                <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="{{ route('admin.news.index') }}"><i class="fa fa-circle-o text-red"></i> News/ Event</a>
                </li>
            <?php
                $subMenu = ['admin.add_team', 'admin.admin_all_team', 'admin.edit_team'];
                ?>

                <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="{{ route('admin.admin_all_team') }}"><i class="fa fa-circle-o text-red"></i> Our Team</a>
                </li>



                <?php
                $subMenu = ['admin.add_client_testimonial', 'admin.admin_all_client_testimonial', 'admin.edit_client_testimonial'];
                ?>

                <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="{{ route('admin.admin_all_client_testimonial') }}"><i class="fa fa-circle-o text-red"></i> Client Testimonial</a>
                </li>
                <?php
                $subMenu = ['admin.association_web_url', 'admin.association_web_url_add', 'admin.association_web_url_edit'];
                ?>

                <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="{{ route('admin.association_web_url') }}"><i class="fa fa-circle-o text-red"></i> Association Web Link</a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <!--<div class="pull-right hidden-xs">-->
        <!--    <b>Hotline</b> 01884-697775-->
        <!--</div>-->
        <strong>Developed by <a target="_blank" href="https://github.com/mdrafiunislam17">MD RAFIUN ISLAM</a></strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('themes/back/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('themes/back/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('themes/back/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
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
