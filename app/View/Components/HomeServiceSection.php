<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\JobCategory;
use Illuminate\Support\Str;

class HomeServiceSection extends Component
{
    public $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch all job categories and truncate descriptions to 5 words
        $this->categories = JobCategory::all()->map(function ($category) {
            $category->description = Str::words($category->description, 5, '...');
            return $category;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home-service-section');
    }
}
