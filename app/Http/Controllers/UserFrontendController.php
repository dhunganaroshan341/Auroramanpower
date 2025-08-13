<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMail;
use App\Models\BannerSliderVideo;
use App\Models\CallToAction;
use App\Models\Category;
use App\Models\Destination;
use App\Models\TourPackage;
use App\SampleData\HomeSampleData;
use Illuminate\Http\Request;
use App\Models\frontend;
use App\Models\User;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Post;
use App\Models\HomeSlide;
use App\Models\Notice;
use App\Models\PageBanner;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserFrontendController extends Controller
{

   public function home()
{
    $frontend = Setting::first();
    $homeslides = HomeSlide::where('status', 'Active')->get();
    $testimonials = Testimonial::where('status', 'Active')->get();
    $destinations = TourPackage::where('status', 'Active')->get();
    $topDestinations = TourPackage::with('images','country')->where('status', 'Active')->where('top_deal',1)->get();
    // $topDeals =$topDestinations;
    // $favDestinations = TourPackage::where('status', 'Active')->where('favourite_destination',1)->get();

    $clients = \App\Models\Client::with('albums')->get();
    $services = Service::where('status', 1)->get();
    $content_title = "Home";
    $cta = CallToAction::where('page', 'home')->first();
    $posts = Post::with('categories', 'postImages')->latest()->take(6)->get();

$video = BannerSliderVideo::latest()->first();



    return view('frontend.home', compact([

        'destinations',
        'video',
        'posts',
        'cta',
        'services',
        'frontend',
        'homeslides',
        'testimonials',
        'content_title',
        'clients',

    ]));
}

    public function aboutUs()
{

    // Fetch rest of members excluding top members, paginated
    $members = User::whereNotIn('id', [1, 2])->paginate(6);

    $pageBanner = PageBanner::where('page','about')->first();
    $frontend = Setting::first();
    $cta = CallToAction::where('page', 'about')->first();
    $pageDescription = Setting::first()->work_description;
    $pageDescriptionImage  = Setting::first()->about_image;
    $content_title="About Us";

    return view('frontend.about', compact(
        'pageDescription', 'pageDescriptionImage', 'cta',  'members', 'frontend', 'content_title', 'pageBanner'
    ));
}


    public function service()
    {
        $services = Service::where('status', 1)->get();
        $content_title="Services";
        $pageBanner = PageBanner::where('page','services')->first();

        return view('frontend.services', compact('services','content_title','pageBanner'));
    }

    public function servicedetail($id)
    {
        $serviceDetail = Service::find($id);
        $otherServices = Service::where('status', 1)->where('id', '!=', $id)->get();
        $posts = Post::with('categories', 'postImages')
            ->latest()
            ->get();
            $content_title="Service Detail";

        if (!$serviceDetail || !$posts) {
            abort('404');
        }
        $pageBanner = PageBanner::where('page','services')->first();

        return view('frontend.service-detail', compact('serviceDetail', 'posts','content_title','pageBanner','otherServices'));
    }

   public function blog()
{
    $content_title = "Blogs";
    $pageBanner = PageBanner::where('page', 'blog')->first();

    $posts = Post::with(['categories', 'postImages'])
                 ->where('status', 'Active')
                 ->latest()
                 ->paginate(6);

    $categories = Category::withCount('posts')->get();

    $recentPosts = Post::with('categories')
                    ->latest()
                    ->take(3)
                    ->get();

    $popularPosts = Post::with('categories')
                    ->orderBy('views', 'desc')
                    ->take(3)
                    ->get();

    return view('frontend.blog', compact('posts', 'content_title', 'pageBanner', 'categories', 'popularPosts', 'recentPosts'));
}


public function blogsByCategory($title)
{
    $content_title = "Blogs";
    $pageBanner = PageBanner::where('page', 'blog')->first();

    $category = Category::where('title', $title)->first();
    if (!$category) {
        abort(404, 'Category not found');
    }

    $category_title = $category->title;

    // Get posts for this category, active and with postImages, paginate 6
    $posts = $category->posts()
                      ->with('postImages')
                      ->where('status', 'Active')
                      ->latest()
                      ->paginate(6);

    // Fetch all categories with count of posts (optional, for sidebar/filter)
    $categories = Category::withCount('posts')->get();

    // Recent posts - latest 3 posts
    $recentPosts = Post::with('categories')
                       ->latest()
                       ->take(3)
                       ->get();

    // Popular posts - top 3 by views
    $popularPosts = Post::with('categories')
                        ->orderBy('views', 'desc')
                        ->take(3)
                        ->get();

    return view('frontend.blog', compact(
        'posts',
        'category_title',
        'content_title',
        'pageBanner',
        'categories',
        'recentPosts',
        'popularPosts'
    ));
}




public function blogDetail($slug)
{
    $content_title = "Blog Detail";
    $pageBanner = PageBanner::where('page', 'blog')->first();

    $post = Post::with(['createdBy', 'categories', 'postImages', 'comments'])
        ->where('slug', $slug)
        ->firstOrFail();

    $postId = $post->id;

    // View count per session
    $sessionKey = 'post_' . $postId . '_viewed';
    if (!session()->has($sessionKey)) {
        $post->increment('views');
        session()->put($sessionKey, true);
    }

    // Previous and next posts
    $previousPost = Post::where('status', 'Active')
        ->where('id', '<', $postId)
        ->orderBy('id', 'desc')
        ->first();

    $nextPost = Post::where('status', 'Active')
        ->where('id', '>', $postId)
        ->orderBy('id', 'asc')
        ->first();

    // Comments
    $comments = Comment::with('user')
        ->where('commentable_id', $postId)
        ->orderBy('created_at', 'desc')
        ->get();

    // Recent posts
    $recentPosts = Post::with('postImages')
        ->where('status', 'Active')
        ->latest()
        ->take(3)
        ->get();

    $recentIds = $recentPosts->pluck('id')->toArray();

    // Get all category IDs associated with this post
    $categoryIds = $post->categories->pluck('id')->toArray();

    // Related posts (any post sharing at least one category)
    $relatedPosts = Post::with('postImages')
        ->where('status', 'Active')
        ->whereNotIn('id', $recentIds)
        ->whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds);
        })
        ->latest()
        ->take(3)
        ->get();

    // Fallback if no related posts
    if ($relatedPosts->isEmpty()) {
        $relatedPosts = Post::with('postImages')
            ->where('status', 'Active')
            ->whereNotIn('id', $recentIds)
            ->inRandomOrder()
            ->take(3)
            ->get();
    }

    // Categories with post count
    $categories = Category::where('status', 'Active')
        ->withCount('posts')
        ->get();

    // Optional: Tags
    $tags = $post->tags ?? [];

    // Meta description
    $processedDescription = $post->title;
    if (!empty($pageBanner?->title)) {
        $processedDescription .= ' → ' . Str::words(strip_tags($pageBanner->title), 5, '...');
    }

    return view('frontend.blog-detail', compact(
        'post',
        'recentPosts',
        'relatedPosts',
        'categories',
        'comments',
        'content_title',
        'pageBanner',
        'processedDescription',
        'previousPost',
        'nextPost',
        'tags'
    ));
}




public function searchBlogs(Request $request)
{
    $query = Post::query();

    // Search by keyword in title or description
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function ($q) use ($keyword) {
            $q->where('title', 'LIKE', '%' . $keyword . '%')
              ->orWhere('description', 'LIKE', '%' . $keyword . '%');
        });
    }

    // Filter by category
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // Filter by tag (assuming you have a relation or a tag_id)
    if ($request->filled('tag_id')) {
        $query->whereHas('tags', function ($q) use ($request) {
            $q->where('id', $request->tag_id);
        });
    }

    // Limit & get results
    $posts = $query->select('id', 'title', 'slug')
        ->latest()
        ->take(10)
        ->get();

    return response()->view($posts);
}

    public function contactUs()
    {
        $content_title="Home";
        $pageBanner = PageBanner::where('page','contact')->first();

        return view('frontend.contact',compact('content_title','pageBanner'));
    }

   public function storeContactUs(ContactRequest $request)
{
    try {
        // Save to DB
        $contact = Contact::create($request->validated());

        // Send to Gmail
         Mail::to('dhunganaroshan341@gmail.com')->send(new ContactFormMail($contact->toArray()));


        return response()->json(['status' => true, 'message' => 'Message has been submitted & emailed successfully']);
    } catch (\Exception $e) {
    Log::error('Contact form error: '.$e->getMessage());
    return response()->json([
        'status' => false,
        'message' => 'Something went wrong',
        'error' => $e->getMessage()  // <-- Add this line temporarily
    ]);
}
}

    public function destinationGrid(){
        return view('frontend.destination.destination-grid');
    } public function destinationFull(){
        return view('frontend.destination.destination-full');
    }public function destinationSingle(){
        return view('frontend.destination.destination-single');
    }public function destinationList(){
        return view('frontend.destination.destination-list');
    }
    // public function blogSingle(){
    //     return view('frontend.pages.blog-single');
    // }public function blogGrid(){
    //     return view('frontend.pages.blog-grid');
    // }public function blogFull(){
    //     return view('frontend.pages.blog-full');
    // }

}
