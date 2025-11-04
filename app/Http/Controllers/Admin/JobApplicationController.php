<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationRequest;
use App\Models\Application;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobApplicationController extends Controller
{
   public function index(Request $request)
{
    if ($request->ajax()) {
        $applicationsQuery = JobApplication::with(['job.categories', 'job.ourCountry', 'jobSeekerProfile.user']);

        // Only filter by job_id if it's provided in the request
        if ($request->filled('job_id')) {
            $applicationsQuery->where('job_id', $request->job_id);
        }

        // Optional: also filter by category or country if needed
        if ($request->filled('job_category_id')) {
            $applicationsQuery->whereHas('job.categories', function ($q) use ($request) {
                $q->where('id', $request->job_category_id);
            });
        }

        if ($request->filled('our_country_id')) {
            $applicationsQuery->whereHas('job.ourCountry', function ($q) use ($request) {
                $q->where('id', $request->our_country_id);
            });
        }

        return DataTables::of($applicationsQuery)
            ->addIndexColumn()
            ->addColumn('job_title', fn($item) => optional($item->job)->title ?? '-')
            ->addColumn('job_category', function ($item) {
                if ($item->job && $item->job->categories->isNotEmpty()) {
                    return $item->job->categories
                        ->map(fn($cat) => '<span class="badge bg-primary me-1">' . e($cat->name) . '</span>')
                        ->implode(' ');
                }
                return '<em>No Categories</em>';
            })
            ->addColumn('country', fn($item) => optional($item->job->ourCountry)->name ?? '-')
            ->addColumn('job_seeker', fn($item) => optional($item->jobSeekerProfile->user)->full_name ?? '-')
            ->addColumn('status', function ($item) {
                return '<select class="form-select application-status" data-id="' . $item->id . '">
                            <option value="applied" ' . ($item->status == 'applied' ? 'selected' : '') . '>Applied</option>
                            <option value="shortlisted" ' . ($item->status == 'shortlisted' ? 'selected' : '') . '>Shortlisted</option>
                            <option value="rejected" ' . ($item->status == 'rejected' ? 'selected' : '') . '>Rejected</option>
                        </select>';
            })
            ->addColumn('action', fn($item) => view('Admin.Button.button', ['data' => $item])->render())
            ->rawColumns(['status', 'action', 'job_category'])
            ->make(true);
    }

    $extraJs = array_merge(
        config('js-map.admin.datatable.script'),
        config('js-map.admin.summernote.script'),
        config('js-map.admin.buttons.script')
    );

    $extraCss = array_merge(
        config('js-map.admin.datatable.style'),
        config('js-map.admin.summernote.style'),
        config('js-map.admin.buttons.style')
    );

    // Pass job_id to view so you can use it in JS to append to AJAX URL
    $jobId = $request->job_id ?? null;

    return view('Admin.pages.JobApplication.jobApplicationIndex', compact('extraJs', 'extraCss', 'jobId'));
}



    public function store(JobApplicationRequest $request)
    {
        $application = Application::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully!',
            'data' => $application
        ]);
    }

    public function update(JobApplicationRequest $request, string $id)
    {
        $application = Application::findOrFail($id);
        $application->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Application updated successfully!',
            'data' => $application
        ]);
    }

    public function manageStatus(string $id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:applied,shortlisted,rejected'
        ]);

        $application = Application::findOrFail($id);
        $application->status = $request->status;
        $application->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
            'data' => $application
        ]);
    }

    public function destroy(string $id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'Application deleted successfully!'
        ]);
    }

public function smartApply($jobId)
{
    $user = auth()->user();

    // Ensure job seeker profile exists
    $profile = $user->jobSeekerProfile;
    if (!$profile) {
        return response()->json([
            'success' => false,
            'message' => 'Please complete your job seeker profile before applying.'
        ], 422);
    }

    // Ensure job exists
    $job = Job::find($jobId);
    if (!$job) {
        return response()->json([
            'success' => false,
            'message' => 'Job not found.'
        ], 404);
    }

    // Prevent duplicate application
    $alreadyApplied = JobApplication::where('job_id', $job->id)
        ->where('job_seeker_profile_id', $profile->id)
        ->exists();

    if ($alreadyApplied) {
        return response()->json([
            'success' => false,
            'message' => 'You have already applied for this job.'
        ], 409);
    }

    // Create the new application
    $application = JobApplication::create([
        'job_id' => $job->id,
        'job_seeker_profile_id' => $profile->id,
        'status' => 'Pending',
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Your application has been submitted successfully!',
        'data' => $application,
    ], 201);
}


public function manualApply(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'desired_role' => 'required|string|max:255',
        'resume_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        'bio' => 'nullable|string',
    ]);

    // Store file
    $resumePath = $request->file('resume_file')->store('uploads/resumes', 'public');

    // Create JobApplication
    $application = JobApplication::create([
        'job_id' => $id,
        'job_seeker_profile_id' => null, // guest
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'desired_role' => $request->desired_role,
        'bio' => $request->bio,
        'resume_file' => $resumePath,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Your application has been submitted successfully!',
        'data' => $application
    ]);
}


}
