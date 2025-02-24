@extends('layouts.admin')

@section('content')
    <div class="row">
        @php
            $infoBoxes = [
                ['route' => 'admin.products', 'color' => 'aqua', 'icon' => 'fa-cube', 'text' => 'Product', 'count' => $data['projects']],
                ['route' => 'admin.all_about', 'color' => 'yellow', 'icon' => 'fa-info-circle', 'text' => 'About Us', 'count' => ''],
                ['route' => 'admin.admin_all_team', 'color' => 'red', 'icon' => 'fa-users', 'text' => 'Team Members', 'count' => $data['teams']],
                ['route' => 'admin.admin_all_slider', 'color' => 'yellow', 'icon' => 'fa-image', 'text' => 'Slider', 'count' => $data['sliders']],
                ['route' => 'admin.all_certificate', 'color' => 'green', 'icon' => 'fa-certificate', 'text' => 'Certificate & Membership', 'count' => $data['certificates']],
                ['route' => 'admin.admin_all_service', 'color' => 'aqua', 'icon' => 'fa-briefcase', 'text' => 'Business Area', 'count' => $data['services']],
                ['route' => 'admin.gallery-images.index', 'color' => 'red', 'icon' => 'fa-picture-o', 'text' => 'Gallery', 'count' => $data['gallery']],
                ['route' => 'admin.all.client', 'color' => 'aqua', 'icon' => 'fa-user-plus', 'text' => 'Customer', 'count' => $data['clients']],
                ['route' => 'admin.news.index', 'color' => 'blue', 'icon' => 'fa-newspaper-o', 'text' => 'News/ Event', 'count' => $data['news']],
                ['route' => 'admin.jobs', 'color' => 'yellow', 'icon' => 'fa-briefcase', 'text' => 'Job Apply Request', 'count' => $data['job_request']],
                ['route' => 'admin.job.notice', 'color' => 'aqua', 'icon' => 'fa-bullhorn', 'text' => 'Job Notice', 'count' => $data['job_notice']],
            ];
        @endphp

        @foreach($infoBoxes as $box)
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-{{ $box['color'] }}">
                    <div class="panel-heading text-center">
                        <a href="{{ route($box['route']) }}" style="text-decoration: none; color: inherit;">
                            <i class="fa {{ $box['icon'] }} fa-3x"></i>
                            <h4>{{ $box['text'] }}</h4>
                        </a>
                    </div>
                    <div class="panel-body text-center">
                        <h3><strong>{{ $box['count'] ?? 0 }}</strong></h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
