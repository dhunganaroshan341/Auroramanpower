<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Job;

class Jobslider extends Component
{
    public $jobs;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch the latest 6 jobs
        $jobs = Job::latest()->take(6)->get();

        // If no jobs found, leave it empty
        if ($jobs->count() === 0) {
            $this->jobs = collect();
            return;
        }

        // If less than 6, repeat randomly to fill up to 6
        if ($jobs->count() < 6) {
            $needed = 6 - $jobs->count();
            $extra = $jobs->random(min($needed, $jobs->count()));
            $this->jobs = $jobs->concat($extra)->shuffle();
        } else {
            $this->jobs = $jobs;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.jobslider', [
            'jobs' => $this->jobs
        ]);
    }
}
