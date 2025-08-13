<?php


namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogAndNewsSection extends Component
{
    public $posts;

   public function __construct()
{
   $this->posts = Post::with(['postImages', 'categories'])
    ->whereNotNull('slug')       // slug is NOT null
    ->where('slug', '!=', '')    // slug is NOT empty string
    ->latest()
    ->take(5)
    ->get();

}


    public function render(): View|Closure|string
    {
        return view('components.blog-and-news-section');
    }
}
