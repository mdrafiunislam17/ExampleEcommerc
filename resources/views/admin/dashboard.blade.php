@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.products')}}" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-cube"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Product</span>
                    <span class="info-box-number">{{ $data['projects'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.all_about')}}" class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-picture-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">About Us</span>
                    <span class="info-box-number"></span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.admin_all_team')}}" class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-picture-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Team Members</span>
                    <span class="info-box-number">{{ $data['teams'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.admin_all_slider')}}" class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-image"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Slider</span>
                    <span class="info-box-number">{{ $data['sliders'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.all_certificate')}}" class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-image"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Certificate & Membership</span>
                    <span class="info-box-number">{{ $data['certificates'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.admin_all_service')}}" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-cube"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Busniess Area</span>
                    <span class="info-box-number">{{ $data['services'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.gallery-images.index')}}" class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-picture-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Gallery</span>
                    <span class="info-box-number">{{ $data['gallery'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.all.client')}}" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Customer</span>
                    <span class="info-box-number">{{ $data['clients'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>



        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.news.index')}}" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-cube"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">News/ Event</span>
                    <span class="info-box-number">{{ $data['news'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.jobs')}}" class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-image"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Job Apply Request</span>
                    <span class="info-box-number">{{ $data['job_request'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('admin.job.notice')}}" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-cube"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Job Notice</span>
                    <span class="info-box-number">{{ $data['job_notice'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <!-- /.col -->
    </div>

@stop
