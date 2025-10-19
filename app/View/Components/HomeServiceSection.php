<?php

namespace App\View\Components;

use App\Models\JobCategory; // or Page section if you prefer
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HomeServiceSection extends Component
{
    public $services;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch active services/job categories (latest first)
        $this->services = JobCategory::latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
      public function render(): View|Closure|string
    {
        // Pass $services explicitly to view (optional but safer)
        return view('components.home-service-section', [
            'services' => $this->services
        ]);
    }
}
