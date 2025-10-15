<?php

namespace App\Http\Controllers;

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
    public function create()
    {
        return view('frontend.pages.jobseeker.upload-resume');
    }

    /**
     * Store a new Job Seeker profile.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|max:20',
            'bio'         => 'nullable|string',
            'skills'      => 'nullable|string',
            'experience'  => 'nullable|string',
            'education'   => 'nullable|string',
            'resume_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'password'    => 'nullable|string|confirmed|min:6',
        ]);

        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name'     => $validated['name'],
                'phone'    => $validated['phone'],
                'role'    => 'User',
                'password' => $validated['password'] ? Hash::make($validated['password']) : Hash::make(uniqid()),
            ]
        );

        if ($request->hasFile('resume_file')) {
            $validated['resume_file'] = $request->file('resume_file')->store('resumes', 'public');
        }

        JobSeekerProfile::create([
            'user_id'     => $user->id,
            'bio'         => $validated['bio'] ?? null,
            'skills'      => $validated['skills'] ?? null,
            'experience'  => $validated['experience'] ?? null,
            'education'   => $validated['education'] ?? null,
            'resume_file' => $validated['resume_file'],
        ]);

        return redirect()->back()->with('success', 'Profile created successfully!');
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
            'name'  => $validated['name'],
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
