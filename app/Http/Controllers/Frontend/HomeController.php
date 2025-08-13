<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function about()
    {
        return view('frontend.home/about');
    }
    public function contact()
    {
        return view('frontend.home/contact');
    }
    public function index()
    {
        return view('frontend.home/index');
    }


}
