<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobSeekerProfile;

class JobSeekerProfileController extends Controller
{
    public function create()
    {
        // Just return the blade (it will handle guest/auth display)
        return view('frontend.jobseeker.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'nullable|string|max:20',
            'bio'         => 'nullable|string',
            'skills'      => 'nullable|string',
            'experience'  => 'nullable|string',
            'education'   => 'nullable|string',
            'resume_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Save uploaded resume
        if ($request->hasFile('resume_file')) {
            $validated['resume_file'] = $request->file('resume_file')->store('resumes', 'public');
        }

        // If logged in, attach user_id
        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
        }

        JobSeekerProfile::create($validated);

        return redirect()->back()->with('success', 'CV submitted successfully!');
    }
}
