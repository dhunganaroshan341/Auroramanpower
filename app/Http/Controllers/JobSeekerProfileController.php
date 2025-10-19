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


public function store(Request $request)
{
    DB::beginTransaction();

    try {
        // Validate input
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|max:20',
            'bio'         => 'nullable|string',
            'skills'      => 'nullable|string',
            'experience'  => 'nullable|string',
            'education'   => 'nullable|string',
            'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'password'    => 'nullable|string|min:6|confirmed',
            'job_id'      => 'nullable|exists:jobs,id', // Optional job ID for smart apply
            'desired_role'=> 'nullable|string|max:255',
        ]);

        // Step 1: Determine the user
        $user = Auth::user();

        if (!$user) {
            $existingUser = User::where('email', $validated['email'])->first();
            if ($existingUser) {
                $user = $existingUser;
            } else {
                $user = User::create([
                    'full_name' => $validated['name'],
                    'email'     => $validated['email'],
                    'phone'     => $validated['phone'],
                    'role'      => 'User',
                    'password'  => isset($validated['password']) ? Hash::make($validated['password']) : Hash::make(Str::random(8)),
                ]);
            }

            Auth::login($user);
        }

        // Step 2: Handle resume upload
        $resumePath = $request->hasFile('resume_file')
            ? $request->file('resume_file')->store('resumes', 'public')
            : optional(JobSeekerProfile::where('user_id', $user->id)->first())->resume_file;

        // Step 3: Create or update JobSeekerProfile
        $profile = JobSeekerProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'bio'         => $validated['bio'] ?? null,
                'skills'      => $validated['skills'] ?? null,
                'experience'  => $validated['experience'] ?? null,
                'education'   => $validated['education'] ?? null,
                'resume_file' => $resumePath,
            ]
        );

        // Step 4: Smart apply if job_id is present
        if (isset($validated['job_id'])) {
            JobApplication::updateOrCreate(
                [
                    'job_id' => $validated['job_id'],
                    'job_seeker_profile_id' => $profile->id,
                ],
                [
                    'name'         => $user->full_name,
                    'email'        => $user->email,
                    'phone'        => $user->phone,
                    'resume_file'  => $resumePath,
                    'bio'          => $profile->bio,
                    'desired_role' => $validated['desired_role'] ?? null,
                    'status'       => 'Pending',
                ]
            );
        }

        DB::commit();

        // Redirect smartly
        if (isset($validated['job_id'])) {
            return redirect()->route('jobById', ['id' => $validated['job_id']])
                             ->with('success', 'Profile saved and applied successfully!');
        }

        return redirect()->route('index')->with('success', 'Profile saved successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Something went wrong. Please try again.')->withInput();
    }
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
