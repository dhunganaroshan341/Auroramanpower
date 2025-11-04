<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
 use App\Models\Job;
use App\Models\JobCategory;
use App\Models\OurCountry;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about()
    {
        return view('home/about');
    } public function categories()
    {
          $categories = JobCategory::all(); // or paginate if needed
        return view('frontend.pages.categories',compact('categories'));
    }
    public function job()
    {
        return view('frontend.pages/job/hire');
    }
    public function job2()
    {
        return view('frontend.pages/job/job2');
    }

public function job3(Request $request)
{
    // Get filter parameters
    $searchTitle = $request->query('search');        // Job title
    $categoryId  = $request->query('category_id');  // Optional category filter
    $countryId   = $request->query('country_id');   // Optional country filter

    // Base query for all jobs
    $jobsQuery = Job::with(['ourCountry', 'categories', 'vacancy']);

    // Apply filters strictly
    if ($searchTitle) {
        $jobsQuery->where('title', 'like', '%' . $searchTitle . '%');
    }

    if ($categoryId) {
        $jobsQuery->whereHas('categories', function ($q) use ($categoryId) {
            $q->where('id', $categoryId);
        });
    }

    if ($countryId) {
        $jobsQuery->where('our_country_id', $countryId);
    }

    // Filtered jobs list
    $jobs = $jobsQuery->orderBy('created_at', 'desc')->get();

    // Latest jobs section (filtered)
    $latestJobs = (clone $jobsQuery)
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

    // Top 3 categories with most filtered jobs
    $topCategories = JobCategory::withCount(['jobs as filtered_jobs_count' => function ($q) use ($searchTitle, $categoryId, $countryId) {
        if ($searchTitle) $q->where('title', 'like', '%' . $searchTitle . '%');
        if ($countryId) $q->where('our_country_id', $countryId);
    }])->orderBy('filtered_jobs_count', 'desc')
      ->take(3)
      ->get();

    // Top category-wise jobs (filtered)
    $categoryJobs = $topCategories->map(function ($category) use ($searchTitle, $countryId) {
        $jobs = $category->jobs()
            ->when($searchTitle, fn($q) => $q->where('title', 'like', '%' . $searchTitle . '%'))
            ->when($countryId, fn($q) => $q->where('our_country_id', $countryId))
            ->with('vacancy')
            ->get();

        return [
            'category_name' => $category->name,
            'jobs' => $jobs,
        ];
    });

    // All categories and countries for filters
    $jobCategories = JobCategory::all();
    $jobCountries  = OurCountry::all();

    return view('frontend.pages.job.job3', compact(
        'latestJobs',
        'categoryJobs',
        'jobs',
        'topCategories',
        'jobCategories',
        'jobCountries'
    ));
}




    public function job4()
    {
        return view('frontend.pages/job/job4');
    }
    public function jobDetails()
    {
        return view('frontend.pages/job/jobDetails');
    }
     public function jobDetailsById($id)
{
    // Fetch the job by ID with country and categories
    $job = Job::with(['ourCountry', 'categories'])->findOrFail($id);

    // Return the job details view
    return view('frontend.pages.job.jobDetailsDynamic', compact('job'));
}
    public function portfolio()
    {
        return view('frontend.pages/portfoliyo/portfolio');
    }
    public function portfolio2()
    {
        return view('frontend.pages/portfoliyo/portfolio2');
    }
    public function portfolio3()
    {
        return view('frontend.pages/portfoliyo/portfolio3');
    }
    public function pageError()
    {
        return view('frontend.pages/pageError');
    }
    public function faq()
    {
        return view('frontend.pages/faq');
    }
    public function login()
    {
        return view('frontend.pages/login');
    }
    public function signup()
    {
        return view('frontend.pages/signup');
    }
    public function team()
    {
        return view('frontend.pages/team');
    }
    public function testimonial()
    {
        return view('frontend.pages/testimonial');
    }
}
