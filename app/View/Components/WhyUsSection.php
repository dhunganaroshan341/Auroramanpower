<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WhyUsSection extends Component
{
    public $why_us_content; // <-- use this variable name

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch the page with slug 'why-us'
        $this->why_us_content = Page::where('slug', 'why-us')->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Pass the variable to the Blade view
        return view('components.why-us-section', [
            'why_us_content' => $this->why_us_content
        ]);
    }
}
