<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobApplication;
use App\Models\Page;
use App\Models\HomeSlide;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Achievement;
use App\Models\Client;
use App\Models\GalleryAlbum;
use App\Models\Notice;
use App\Models\NewsletterSubscriber as Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index() {
        // Users
        $users = User::all();
        $admin = $users->where('role','Admin')->count();
        $user = $users->where('role','User')->count();
        $totaluser = $users->count();

        // Posts & Packages
        $today_post = Post::whereDate('created_at', today())->count();
        $totalpost = Post::count();
        $totalPackages = TourPackage::count();

        // Jobs
        $jobs = Job::count();
        $jobCategories = JobCategory::count();
        $pendingApplications = JobApplication::where('status','pending')->count();

        // Pages & Content
        $pages = Page::count();
        $banners = HomeSlide::count();
        $services = Service::count();
        $testimonials = Testimonial::count();
        $achievements = Achievement::count();
        $clients = Client::count();
        $gallery = GalleryAlbum::count();
        $notices = Notice::count();
        $blogs = Post::count();
        $newsletters = Newsletter::count();

        // JS for charts if needed
        $extraJs = array_merge(config('js-map.admin.chartjs'));

        return view('Admin.pages.Dashboard.index', compact(
            'totalPackages', 'totaluser', 'admin', 'user',
            'today_post', 'totalpost', 'jobs', 'jobCategories',
            'pendingApplications', 'pages', 'banners', 'services',
            'testimonials', 'achievements', 'clients', 'gallery',
            'notices', 'blogs', 'newsletters', 'extraJs'
        ));
    }
}
