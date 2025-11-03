<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class DynamicPageController extends Controller
{
    //
    public function companyOverview()
    {
        // $content = Page::where('slug', 'company-overview')->firstOrFail();
        $content = "hello";
        return view('frontend.home.company-overview', compact('content'));
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
    // Fetch the album
    $album = \App\Models\GalleryAlbum::where('title', 'License and Certificates')->firstOrFail();

    // Get all media items under this album
    $mediaItems = $album->media; // Assuming GalleryAlbum has 'media()' relationship

    // Pass the album and its media to the view
    return view('frontend.home.lisence-certificates', compact('album', 'mediaItems'));
}


    public function organizationalChart()
    {
        // $content = Page::where('slug', 'organizational-chart')->firstOrFail();
        $page = "hello";

        return view('frontend.home.organizational-chart', compact('page'));
    }

    public function requiredDocuments()
    {
        // $content = Page::where('slug', 'required-documents')->firstOrFail();
        $content = "hello";
        return view('frontend.pages.required-documents', compact('content'));
    }

    public function recruitmentProcess()
    {
        // $content = Page::where('slug', 'recruitment-process')->firstOrFail();
        $content = "hello";

        return view('frontend.pages.recruitment-procedure', compact('content'));
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
