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
        return view('frontend.pages.jobseeker.upload-resume');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'name'        => 'nullable|string|max:255',
        'email'       => 'nullable|email',
        'phone'       => 'nullable|string|max:20',
        'bio'         => 'nullable|string',
        'skills'      => 'nullable|string',
        'experience'  => 'nullable|string',
        'education'   => 'nullable|string',
        'resume_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Store resume file
    if ($request->hasFile('resume_file')) {
        $validated['resume_file'] = $request->file('resume_file')->store('resumes', 'public');
    }

    // Attach user_id if logged in
    if (Auth::check()) {
        $validated['user_id'] = Auth::id();
    }

    JobSeekerProfile::create($validated);

    return redirect()->back()->with('success', 'CV submitted successfully!');
}

}
