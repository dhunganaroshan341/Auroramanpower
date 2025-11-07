<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationRequest;
use App\Models\JobJobApplication;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobApplicationController extends Controller
{
  public function index(Request $request)
{
    if ($request->ajax()) {
        $applicationsQuery = JobApplication::with([
            'job.categories',
            'job.ourCountry',
            'jobSeekerProfile.user'
        ]);

        // Filter by job
        if ($request->filled('job_id')) {
            $applicationsQuery->where('job_id', $request->job_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $applicationsQuery->where('status', $request->status);
        }

        return DataTables::of($applicationsQuery)
            ->addIndexColumn()
            ->addColumn('job_title', fn($item) => optional($item->job)->title ?? '-')
            ->addColumn('job_seeker', fn($item) => optional($item->jobSeekerProfile->user)->full_name ?? '-')
            ->addColumn('status', function ($item) {
                $statuses = ['Pending', 'Reviewed', 'Accepted', 'Rejected'];
                $options = '';

                foreach ($statuses as $status) {
                    $selected = $item->status === $status ? 'selected' : '';
                    $options .= "<option value='{$status}' {$selected}>{$status}</option>";
                }

                return "<select class='form-select application-status' data-id='{$item->id}'>{$options}</select>";
            })
            // ->addColumn('action', fn($item) => view('Admin.Button.button', ['data' => $item])->render())
            ->addColumn('action', function ($item) {
    return '
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-info viewApplicant" data-id="' . $item->id . '">
                <i class="fa fa-eye"></i> View
            </button>

            <button class="btn btn-sm btn-danger deleteData" data-id="' . $item->id . '">
                <i class="fa fa-trash"></i> Delete
            </button>
        </div>
    ';
})

            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    // JS & CSS setup
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

    return view('Admin.pages.JobApplication.jobApplicationIndex', compact('extraJs', 'extraCss'));
}




    public function store(JobApplicationRequest $request)
    {
        $application = JobApplication::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'JobApplication submitted successfully!',
            'data' => $application
        ]);
    }

    public function update(JobApplicationRequest $request, string $id)
    {
        $application = JobApplication::findOrFail($id);
        $application->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'JobApplication updated successfully!',
            'data' => $application
        ]);
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Pending,Reviewed,Accepted,Rejected',
    ]);

    $application = JobApplication::find($id);

    if (!$application) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found.'
        ], 404);
    }

    $application->status = $request->status;
    $application->save();

    return response()->json([
        'success' => true,
        'message' => 'Application status updated successfully.'
    ]);
}


    public function destroy(string $id)
    {
        $application = JobApplication::findOrFail($id);
        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'JobApplication deleted successfully!'
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


public function show($id)
{

    $application = JobApplication::with(['jobSeeker.user'])->find($id);
   
    if (!$application) {
        return response()->json([
            'success' => false,
            'message' => 'JobJobApplication not found'
        ], 404);
    }

    $jobSeeker = $application->jobSeeker;
    $user = $jobSeeker?->user;

    $data = [
        'application_id' => $application->id,
        'job_id' => $application->job_id,
        'status' => $application->status,
        'cover_letter' => $application->cover_letter,

        // From User
        'full_name' => $user?->full_name ?? 'N/A',
        'email' => $user?->email ?? 'N/A',
        'phone' => $user?->phonenumber ?? 'N/A',
        'position' => $user?->position ?? 'N/A',
        'image' => $user?->image ? asset('uploads/' . $user->image) : null,

        // From JobSeeker
        'bio' => $jobSeeker?->bio ?? 'N/A',
        'skills' => $jobSeeker?->skills ?? 'N/A',
        'experience' => $jobSeeker?->experience ?? 'N/A',
        'education' => $jobSeeker?->education ?? 'N/A',
        'resume_file' => $jobSeeker?->resume_file ? asset('uploads/' . $jobSeeker->resume_file) : null,
    ];

    return response()->json(['success' => true, 'data' => $data]);
}



}
