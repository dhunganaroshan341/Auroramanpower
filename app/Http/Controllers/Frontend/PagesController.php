<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about()
    {
        return view('home/about');
    } public function categories()
    {
        return view('frontend.pages.categories');
    }
    public function job()
    {
        return view('frontend.pages/job/hire');
    }
    public function job2()
    {
        return view('frontend.pages/job/job2');
    }
    public function job3()
    {
         $jobs = collect([
        (object)[
            'id' => 1,
            'title' => 'Welder',
            'openings' => 20,
            'vacancy' => (object)[
                'country' => 'UAE',
                'company' => (object)['name' => 'ABC Manpower'],
            ],
            'categories' => [(object)['name' => 'Construction']]
        ],
        (object)[
            'id' => 2,
            'title' => 'Chef',
            'openings' => 15,
            'vacancy' => (object)[
                'country' => 'Qatar',
                'company' => (object)['name' => 'Qatar Co.'],
            ],
            'categories' => [(object)['name' => 'Hospitality']]
        ],
        (object)[
            'id' => 3,
            'title' => 'Software Engineer',
            'openings' => 10,
            'vacancy' => (object)[
                'country' => 'Malaysia',
                'company' => (object)['name' => 'XYZ Pvt. Ltd.'],
            ],
            'categories' => [(object)['name' => 'IT']]
        ]
    ]);
        return view('frontend.pages/job/job3',compact('jobs'));
    }
    public function job4()
    {
        return view('frontend.pages/job/job4');
    }
    public function jobDetails()
    {
        return view('frontend.pages/job/jobDetails');
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
