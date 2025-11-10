<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\JobSeekerProfile;
use App\Models\JobApplication;

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
            'job_id'      => 'nullable|exists:jobs,id',
            'desired_role'=> 'nullable|string|max:255',
        ]);

        // Step 1: Determine user
        $user = Auth::user();

        if (!$user) {
            $user = User::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'full_name' => $validated['name'],
                    'phone'     => $validated['phone'],
                    'role'      => 'User',
                    'password'  => isset($validated['password']) ? Hash::make($validated['password']) : Hash::make(Str::random(8)),
                ]
            );
            Auth::login($user); // Log in new user automatically
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

        $message = isset($validated['job_id']) 
            ? 'Profile saved and applied successfully!' 
            : 'Profile saved successfully!';

        // Return JSON for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => route('index') // tell frontend to redirect
            ]);
        }

        // Normal POST redirect to home
        return redirect()->route('index')->with('success', $message);

    } catch (\Exception $e) {
        DB::rollBack();

        $errorMessage = $e->getMessage() ?: 'Something went wrong!';

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => $errorMessage
            ], 500);
        }

        return redirect()->back()->with('error', $errorMessage)->withInput();
    }
}




    /**
     * Show a Job Seeker profile (read).
     */
  public function show()
{
    $user = Auth::user();

    // Get the user's job seeker profile
    $profile = JobSeekerProfile::with('user')
                ->where('user_id', $user->id)
                ->first();
 // Get all applications for this user directly
    $appliedJobs = JobApplication::with('job')
                    ->where('job_seeker_profile_id', $user->id)
                    ->get();
    // Optional: create a profile if it doesn't exist yet
    if (!$profile) {
        $profile = JobSeekerProfile::create(['user_id' => $user->id]);
    }

    // Also get all applied jobs for this user
    $applications = $profile->applications()->with('job')->get();

    return view('frontend.pages.jobseeker.profile', compact('user','profile', 'appliedJobs'));
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
    public function update(Request $request, $id=null)
    {
        // $profile = JobSeekerProfile::findOrFail($id);
          $profile = auth()->user()->jobSeekerProfile; 
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
