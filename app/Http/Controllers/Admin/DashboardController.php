<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Models\Certificate;
use App\Models\Client;
use App\Models\Equipment;
use App\Models\GalleryImage;
use App\Models\GalleryItem;
use App\Models\JobNotice;
use App\Models\Member;
use App\Models\News;
use App\Models\OnlineJob;
use App\Models\Product;
use App\Models\Project;
use App\Models\Say;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve counts for various models
        $data = [
            'projects' => Product::count(),
            'sliders' => Slider::count(),
            'gallery' => GalleryImage::count(),
            'job_notice' => JobNotice::count(),
            'job_request' => OnlineJob::count(),
            'clients' => Client::count(),
            'services' => Service::count(),
            'certificates' => Certificate::count(),
            'news' => News::count(),
            'teams' => Team::count(),
        ];

        // Pass the data to the view
        return view('admin.dashboard', compact('data'));
    }
}
