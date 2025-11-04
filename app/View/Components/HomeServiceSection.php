<?php

namespace App\View\Components;

use App\Models\JobCategory; // or Page section if you prefer
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
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
        // Pass $services explicitly to view (optional but safer)
        return view('components.home-service-section', [
            'services' => $this->categories
        ]);
    }
}
