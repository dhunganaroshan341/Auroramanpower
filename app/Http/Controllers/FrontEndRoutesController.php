<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\Request;

class FrontEndRoutesController extends Controller
{
    //
    public function showTourPackageBySlug($slug)
    {
        // Logic to retrieve and display the tour package by slug
        // This could involve querying the database for a TourPackage model
        // and returning a view with the package details.
        $package = TourPackage::where('slug', $slug)->firstOrFail();
       $totalDays = $package->itineraries
    ->filter(fn($item) => is_numeric($item->day_number))
    ->sum(fn($item) => (int) $item->day_number);
$otherPackages = TourPackage::where('country_id', $package->country_id)->get();
        return view('frontend.pages.tour-package-single', compact('package','totalDays','otherPackages'));
    }
}
