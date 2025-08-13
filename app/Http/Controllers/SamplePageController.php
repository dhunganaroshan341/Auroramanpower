<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use NerdSnipe\LaravelCountries\Facades\LaravelCountries;

class SamplePageController extends Controller
{




public function NotFoundBladePage() {
        return view('frontend.pages.404-1');
    }

public function aboutBladePage() {
        return view('frontend.pages.about');
    }

public function blog_fullBladePage() {
        return view('frontend.pages.blog-full');
    }

public function blog_gridBladePage() {
        return view('frontend.pages.blog-grid');
    }

public function blog_leftBladePage() {
        return view('frontend.pages.blog-left');
    }

public function blog_listBladePage() {
        return view('frontend.pages.blog-list');
    }

public function blog_masonryBladePage() {
        return view('frontend.pages.blog-masonry');
    }

public function blog_single_fullBladePage() {
        return view('frontend.pages.blog-single-full');
    }

public function blog_singleBladePage() {
        return view('frontend.pages.blog-single');
    }

public function bookingBladePage() {
        return view('frontend.pages.booking');
    }

public function car_bookingBladePage() {
        return view('frontend.pages.car-booking');
    }

public function car_detailBladePage() {
        return view('frontend.pages.car-detail');
    }

public function car_gridBladePage() {
        return view('frontend.pages.car-grid');
    }

public function car_listBladePage() {
        return view('frontend.pages.car-list');
    }

public function cartBladePage() {
        return view('frontend.pages.cart');
    }

public function checkoutBladePage() {
        return view('frontend.pages.checkout');
    }

public function confirmationBladePage() {
        return view('frontend.pages.confirmation');
    }

public function contactBladePage() {
        return view('frontend.pages.contact');
    }

public function dashboard_add_newBladePage() {
        return view('frontend.pages.dashboard-add-new');
    }

public function dashboard_historyBladePage() {
        return view('frontend.pages.dashboard-history');
    }

public function dashboard_listBladePage() {
        return view('frontend.pages.dashboard-list');
    }

public function dashboard_messagesBladePage() {
        return view('frontend.pages.dashboard-messages');
    }

public function dashboard_my_profileBladePage() {
        return view('frontend.pages.dashboard-my-profile');
    }

public function dashboard_reviewsBladePage() {
        return view('frontend.pages.dashboard-reviews');
    }

public function dashboardBladePage() {
        return view('frontend.pages.dashboard');
    }

public function destination_fullBladePage() {
        return view('frontend.pages.destination-full');
    }

public function destination_gridBladePage() {
    $countries = LaravelCountries::getCountries();
    $tourPackages = \App\Models\TourPackage::all(); // Assuming you have a TourPackage model
    $services = \App\Models\Service::all(); // Assuming you have a Service model
    $tourPackageTypes = \App\Models\TourPackageType::all(); // Assuming you have a TourPackageType model
        return view('frontend.pages.destination-grid',compact('countries','tourPackages','services','tourPackageTypes'));
    }

public function destination_leftBladePage() {
        return view('frontend.pages.destination-left');
    }

public function destination_listBladePage() {
        return view('frontend.pages.destination-list');
    }

public function destination_masonryBladePage() {
        return view('frontend.pages.destination-masonry');
    }

public function destination_single_fullBladePage() {
        return view('frontend.pages.destination-single-full');
    }

public function destination_singleBladePage() {
        return view('frontend.pages.destination-single');
    }

public function destination_single1BladePage() {
        return view('frontend.pages.destination-single1');
    }

public function faqBladePage() {
        return view('frontend.pages.faq');
    }

public function flight_bookingBladePage() {
        return view('frontend.pages.flight-booking');
    }

public function flight_detailBladePage() {
        return view('frontend.pages.flight-detail');
    }

public function flight_gridBladePage() {
        return view('frontend.pages.flight-grid');
    }

public function flight_listBladePage() {
        return view('frontend.pages.flight-list');
    }

public function forgot_passwordBladePage() {
        return view('frontend.pages.forgot-password');
    }

public function galleryBladePage() {
        return view('frontend.pages.gallery');
    }public function galleryGridpage() {
        return view('frontend.pages.gallery-grid');
    }

public function gallery1BladePage() {
        return view('frontend.pages.gallery1');
    }

public function hotel_bookingBladePage() {
        return view('frontend.pages.hotel-booking');
    }

public function hotel_detailBladePage() {
        return view('frontend.pages.hotel-detail');
    }

public function hotel_gridBladePage() {
        return view('frontend.pages.hotel-grid');
    }

public function hotel_listBladePage() {
        return view('frontend.pages.hotel-list');
    }

public function index_1BladePage() {
        return view('frontend.pages.index-1');
    }

public function index_2BladePage() {
        return view('frontend.pages.index-2');
    }

public function index_3BladePage() {
        return view('frontend.pages.index-3');
    }

public function index_carBladePage() {
        return view('frontend.pages.index-car');
    }

public function index_flightBladePage() {
        return view('frontend.pages.index-flight');
    }

public function index_hotelBladePage() {
        return view('frontend.pages.index-hotel');
    }

public function index_trainBladePage() {
        return view('frontend.pages.index-train');
    }

public function indexBladePage() {
        return view('frontend.pages.index');
    }

public function loginBladePage() {
        return view('frontend.pages.login');
    }

public function pricingBladePage() {
        return view('frontend.pages.pricing');
    }

public function shop_detailBladePage() {
        return view('frontend.pages.shop-detail');
    }

public function shop_grid1BladePage() {
        return view('frontend.pages.shop-grid1');
    }

public function shop_list1BladePage() {
        return view('frontend.pages.shop-list1');
    }

public function testimonialBladePage() {
        return view('frontend.pages.testimonial');
    }

public function train_bookingBladePage() {
        return view('frontend.pages.train-booking');
    }

public function train_detailBladePage() {
        return view('frontend.pages.train-detail');
    }

public function train_gridBladePage() {
        return view('frontend.pages.train-grid');
    }

public function train_listBladePage() {
        return view('frontend.pages.train-list');
    }

public function wishlistBladePage() {
        return view('frontend.pages.wishlist');
    }public function servicesPage() {
        return view('frontend.pages.services-left-right-desc');
    }

}
