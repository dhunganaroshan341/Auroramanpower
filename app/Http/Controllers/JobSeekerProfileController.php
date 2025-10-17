<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\JobSeekerProfile;

class JobSeekerProfileController extends Controller
{
    /**
     * Show the CV upload / create form.
     */
  public function create(Request $request)
{
    $jobId = $request->query('job_id'); // optional
    $job = $jobId ? Job::find($jobId) : null;

    return view('frontend.pages.jobseeker.upload-resume', compact('job'));
}


    /**
     * Store a new Job Seeker profile.
     */


public function store(Request $request, Job $job = null)
{
    // Validate input, including password confirmation
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'email'       => 'required|email|max:255|unique:users,email',
        'phone'       => 'required|string|max:20',
        'bio'         => 'nullable|string',
        'skills'      => 'nullable|string',
        'experience'  => 'nullable|string',
        'education'   => 'nullable|string',
        'resume_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        'password'    => 'required|string|min:6|confirmed',
    ]);

    // Create the user
    $user = User::create([
        'full_name' => $validated['name'],
        'email'     => $validated['email'],
        'phone'     => $validated['phone'],
        'role'      => 'User',
        'password'  => Hash::make($validated['password']),
    ]);

    // Handle resume upload
    $resumePath = $request->file('resume_file')->store('resumes', 'public');

    // Create job seeker profile
    JobSeekerProfile::create([
        'user_id'     => $user->id,
        'bio'         => $validated['bio'] ?? null,
        'skills'      => $validated['skills'] ?? null,
        'experience'  => $validated['experience'] ?? null,
        'education'   => $validated['education'] ?? null,
        'resume_file' => $resumePath,
    ]);

    // Automatically log in the user
    Auth::login($user);

    // Redirect to home/dashboard after login
    return redirect()->route('home')->with('success', 'User registered and logged in successfully!');
}


    /**
     * Show a Job Seeker profile (read).
     */
    public function show($id)
    {
        $profile = JobSeekerProfile::with('user')->findOrFail($id);
        return view('frontend.pages.jobseeker.view-profile', compact('profile'));
    }

    /**
     * Show the edit form for a Job Seeker profile.
     */
    public function edit($id)
    {
        $profile = JobSeekerProfile::with('user')->findOrFail($id);
        return view('frontend.pages.jobseeker.upload-resume', compact('profile'));
    }

    /**
     * Update an existing Job Seeker profile.
     */
    public function update(Request $request, $id)
    {
        $profile = JobSeekerProfile::findOrFail($id);
        $user = $profile->user;

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|max:20',
            'bio'         => 'nullable|string',
            'skills'      => 'nullable|string',
            'experience'  => 'nullable|string',
            'education'   => 'nullable|string',
            'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'password'    => 'nullable|string|confirmed|min:6',
        ]);

        // Update user info
        $user->update([
            'full_name'  => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        // Update resume if uploaded
        if ($request->hasFile('resume_file')) {
            $validated['resume_file'] = $request->file('resume_file')->store('resumes', 'public');
        }

        $profile->update([
            'bio'         => $validated['bio'] ?? $profile->bio,
            'skills'      => $validated['skills'] ?? $profile->skills,
            'experience'  => $validated['experience'] ?? $profile->experience,
            'education'   => $validated['education'] ?? $profile->education,
            'resume_file' => $validated['resume_file'] ?? $profile->resume_file,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
