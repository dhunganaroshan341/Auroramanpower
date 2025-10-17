<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\DynamicPageController;
use App\Http\Controllers\EmployerJobRequestController;
use App\Http\Controllers\JobSeekerProfileController;
use App\Http\Controllers\UserFrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\SolutionsController;



Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

//  blog
Route::prefix('blog')->group(function () {
    Route::controller(BlogController::class)->group(function () {
            Route::get('/','blog')->name('blog');
            Route::get('/blog/category/{slug}','blogsByCategory')->name('blogsByCategory');
            Route::get('/{slug}','blogDetail')->name('blogDetail');
            Route::get('/1','blogDetail')->name('blogDetailStatic');
    });
});

//  home
Route::prefix('home')->group(function () {
    Route::controller(homeController::class)->group(function () {
        Route::get('/about','about')->name('about');
        Route::get('/contact','contact')->name('contact');
        Route::get('/','index')->name('index');

    });
});
        Route::post('/contact',[UserFrontendController::class,'storeContactUs'])->name('contact.store');


//  job
Route::prefix('pages')->group(function () {
    Route::prefix('job')->group(function () {
        Route::controller(PagesController::class)->group(function () {
            Route::get('/job','job')->name('job');
            Route::get('/job-2','job2')->name('job2'); //kinda like job grid
            Route::get('/job-3','job3')->name('job3');
            Route::get('/job-4','job4')->name('job4');
            Route::get('/job-detaails','jobDetails')->name('jobDetails');
        });
    });
});
    Route::controller(PagesController::class)->group(function(){
            Route::get('/jobs','job3')->name('jobs');
            Route::get('/jobs/{id}','jobDetailsById')->name('jobById');

            Route::get('/hire','job')->name('hire');
            });
Route::post('/jobs/{id}/apply', [JobApplicationController::class, 'manualApply'])
    ->name('jobseeker.mannualApply');

// Smart/auto apply route (for logged-in users)
Route::post('/jobs/{id}/smart-apply', [JobApplicationController::class, 'smartApply'])
    ->name('jobseeker.smartApply')
    ->middleware('auth'); // Only authenticated users

            Route::post('/hire', [EmployerJobRequestController::class, 'store'])->name('hire.submit');
//  portfoliyo
Route::prefix('pages')->group(function () {
    Route::prefix('portfoliyo')->group(function () {
        Route::controller(PagesController::class)->group(function () {
            Route::get('/portfolio','portfolio')->name('portfolio');
            Route::get('/portfolio-2','portfolio2')->name('portfolio2');
            Route::get('/portfolio-3','portfolio3')->name('portfolio3');
        });
    });
});

//  portfoliyo
Route::prefix('pages')->group(function () {
        Route::controller(PagesController::class)->group(function () {
            Route::get('/portfolio','portfolio')->name('portfolio');
            Route::get('/page-error','pageError')->name('pageError');
            Route::get('/faq','faq')->name('faq');
            Route::get('/login','login')->name('login');
            Route::get('/signup','signup')->name('signup');
            Route::get('/team','team')->name('team');
            Route::get('/testimonial','testimonial')->name('testimonial');
            // Show the form (same blade, will use @guest / @auth to adapt)

});

//  portfoliyo
Route::prefix('solutions')->group(function () {
        Route::controller(SolutionsController::class)->group(function () {
            Route::get('/service','service')->name('service');
            Route::get('/service-details','serviceDetails')->name('serviceDetails');
            Route::get('/service-details-2','serviceDetails2')->name('serviceDetails2');
            Route::get('/service-details-3','serviceDetails3')->name('serviceDetails3');
            Route::get('/service-details-4','serviceDetails4')->name('serviceDetails4');
            Route::get('/service-details-5','serviceDetails5')->name('serviceDetails5');
            Route::get('/service-details-6','serviceDetails6')->name('serviceDetails6');
        });
});


        });
Route::get('/cv-upload', [JobSeekerProfileController::class, 'create'])
    ->name('jobseeker.create');

// Handle form submission
Route::post('/cv-upload', [JobSeekerProfileController::class, 'store'])
    ->name('jobseeker.store');
// Dynamic pages
Route::get('/company-overview', [DynamicPageController::class,'companyOverview'])->name('company-overview');
Route::get('/message-from-chairman', [DynamicPageController::class,'messageFromChairman'])->name('message-from-chairman');
Route::get('/license-certificates', [DynamicPageController::class,'licenseCertificates'])->name('license-certificates');
Route::get('/organizational-chart', [DynamicPageController::class,'organizationalChart'])->name('organizational-chart');

Route::get('/required-documents', [DynamicPageController::class,'requiredDocuments'])->name('required-documents');
Route::get('/recruitment-process', [DynamicPageController::class,'recruitmentProcess'])->name('recruitment-process');
// Route::get('/categories', [DynamicPageController::class,'categories'])->name('dynamic-categories');
 Route::get('/categories', [PagesController::class,'categories'])->name('dynamic-categories');
