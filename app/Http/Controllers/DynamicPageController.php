<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class DynamicPageController extends Controller
{
    //
    public function companyOverview()
    {
        $content = Page::where('slug', 'company-overview')->firstOrFail();
        return view('frontend.dynamic-page', compact('content'));
    }
 public function categories()
    {
        $content = Page::where('slug', 'categories')->firstOrFail();
        return view('frontend.dynamic-page', compact('content'));
    }

    public function messageFromChairman()
    {
        $content = Page::where('slug', 'message-from-chairman')->firstOrFail();
        return view('frontend.message-from-chairman', compact('content'));
    }

    public function licenseCertificates()
    {
        $content = Page::where('slug', 'license-certificates')->firstOrFail();
        return view('frontend.dynamic-page', compact('content'));
    }

    public function organizationalChart()
    {
        $content = Page::where('slug', 'organizational-chart')->firstOrFail();
        return view('frontend.dynamic-page', compact('content'));
    }

    public function requiredDocuments()
    {
        $content = Page::where('slug', 'required-documents')->firstOrFail();
        return view('raw-dynamic', compact('content'));
    }

    public function recruitmentProcess()
    {
        $content = Page::where('slug', 'recruitment-process')->firstOrFail();
        return view('raw-dynamic', compact('content'));
    }

    public function ourClients()
    {
        $content = Page::where('slug', 'our-clients')->firstOrFail();
        return view('frontend.dynamic-page', compact('content'));
    }

    public function vacancies()
    {
        $content = Page::where('slug', 'vacancies')->firstOrFail();
        return view('frontend.dynamic-page', compact('content'));
    }
}
