<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\PageBanner;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
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

    return view('frontend.blog.blog', compact('posts', 'content_title', 'pageBanner', 'categories', 'popularPosts', 'recentPosts'));
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

    return view('frontend.blog.blog', compact(
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

    return view('frontend.blog.blogDetails', compact(
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

}
