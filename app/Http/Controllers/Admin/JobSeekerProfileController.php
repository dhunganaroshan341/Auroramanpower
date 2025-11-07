<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\JobSeekerProfile;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class JobSeekerProfileController extends Controller
{
    /**
     * Display a listing of jobs under a specific vacancy.
     */
    public function index(Request $request)
{
    if ($request->ajax()) {
        $profiles = JobSeekerProfile::with('user')->latest();

        return datatables()->eloquent($profiles)
            ->addIndexColumn()
            ->addColumn('name', fn($profile) => e(optional($profile->user)->full_name ?? '—'))
            ->addColumn('email', fn($profile) => e(optional($profile->user)->email ?? '—'))
            ->addColumn('phone', fn($profile) => e(optional($profile->user)->phonenumber ?? '—'))
            ->addColumn('skills', fn($profile) => $profile->skills ? '<span class="badge bg-info">' . e($profile->skills) . '</span>' : '<em>Not Mentioned</em>')
            ->addColumn('experience', fn($profile) => e($profile->experience ?? '—'))
            ->addColumn('education', fn($profile) => e($profile->education ?? '—'))
           



            // ->addColumn('action', fn($profile) => view('Admin.Button.button', ['data' => $profile])->render())
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

            ->rawColumns(['action', 'skills'])
            ->make(true);
    }
 $extraJs = array_merge(
        config('js-map.admin.datatable.script'),
        config('js-map.admin.summernote.script'),
        config('js-map.admin.select2.script'),
        config('js-map.admin.buttons.script')
    );

    $extraCs = array_merge(
        config('js-map.admin.datatable.style'),
        config('js-map.admin.summernote.style'),
        config('js-map.admin.select2.style'),
        config('js-map.admin.buttons.style')
    );

    return view('Admin.pages.JobSeekers.jobSeekersIndex', [
        'extraJs' => $extraJs,
        'extraCs' => $extraCs
    ]);
}



    /**
     * Store a newly created job under a specific vacancy.
     */
  // Store a newly created job
public function store(JobRequest $request, Vacancy $vacancy)
{
    DB::beginTransaction();
    try {
        $data = $request->validated();

        // Assign vacancy
        $data['vacancy_id'] = $vacancy->id;

        // Openings logic
        if ($request->input('openings_mode') === 'male-female') {
            $data['male_opening'] = (int) $request->input('male_opening', 0);
            $data['female_opening'] = (int) $request->input('female_opening', 0);
            $data['total_openings'] = $data['male_opening'] + $data['female_opening'];
        } else {
            $data['total_openings'] = (int) $request->input('total_openings', 0);
            $data['male_opening'] = 0;
            $data['female_opening'] = 0;
        }

        // Image upload
        $data['image'] = $this->uploadSingleImage($request, 'image', 'uploads/jobs');

        // Create job
        $job = Job::create($data);

        // Sync categories (many-to-many)
        $job->categories()->sync($request->input('category_ids', []));

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Job created successfully!',
            'data' => $job,
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

// Show a specific job
public function show(Vacancy $vacancy, Job $job)
{
    abort_if($job->vacancy_id !== $vacancy->id, 404);

    // Load related models for edit form
    $job->load(['categories', 'ourCountry', 'employer']);

    return response()->json([
        'success' => true,
        'data' => $job,
    ]);
}

// Update a specific job
public function update(JobRequest $request, Vacancy $vacancy, Job $job)
{
    abort_if($job->vacancy_id !== $vacancy->id, 404);

    DB::beginTransaction();
    try {
        $data = $request->validated();

        // Openings logic
        if ($request->input('openings_mode') === 'male-female') {
            $data['male_opening'] = (int) $request->input('male_opening', 0);
            $data['female_opening'] = (int) $request->input('female_opening', 0);
            $data['total_openings'] = $data['male_opening'] + $data['female_opening'];
        } else {
            $data['total_openings'] = (int) $request->input('total_openings', 0);
            $data['male_opening'] = 0;
            $data['female_opening'] = 0;
        }

        // Image upload
        $data['image'] = $this->uploadSingleImage($request, 'image', 'uploads/jobs', $job);

        // Update job
        $job->update($data);

        // Sync categories
        $job->categories()->sync($request->input('category_ids', []));

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Job updated successfully!',
            'data' => $job,
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}


    /**
     * Delete a specific job under a vacancy.
     */
    public function destroy(Vacancy $vacancy, Job $job)
    {
        abort_if($job->vacancy_id !== $vacancy->id, 404);

        DB::beginTransaction();
        try {
            if ($job->image && file_exists(public_path($job->image))) {
                @unlink(public_path($job->image));
            }

            $job->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Job deleted successfully!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Toggle job active/inactive status.
     */
    public function toggleStatus(Vacancy $vacancy, Job $job)
    {
        abort_if($job->vacancy_id !== $vacancy->id, 404);

        $job->status = $job->status === 'Active' ? 'Inactive' : 'Active';
        $job->save();

        return response()->json([
            'success' => true,
            'message' => 'Job status updated.',
        ]);
    }

    /**
     * Handle single image upload.
     */
    private function uploadSingleImage($request, $field, $path, $existing = null)
    {
        if ($request->hasFile($field)) {
            // Delete old image if exists
            if ($existing && $existing->image && file_exists(public_path($existing->image))) {
                @unlink(public_path($existing->image));
            }

            $file = $request->file($field);
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);

            return $path . '/' . $filename;
        }

        return $existing->image ?? null;
    }
    public  function searchJobs(Request $request)
    {
        $query = Job::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        if ($request->filled('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('id', $request->input('category_id'));
            });
        }

        if ($request->filled('country_id')) {
            $query->where('our_country_id', $request->input('country_id'));
        }

        $jobs = $query->with(['employer', 'categories', 'ourCountry'])->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $jobs,
        ]);
    }


   public function getAppliedJobs($id)
{
    $applications = \App\Models\JobApplication::with('job')
        ->where('job_seeker_profile_id', $id)
        ->get();

    $data = $applications->map(function ($app) {
        return [
            'job_id' => $app->job->id ?? null,
            'job_title' => $app->job->title ?? 'N/A',
            'status' => $app->status,
            'applied_on' => $app->created_at->format('Y-m-d H:i'),
        ];
    });

    return response()->json([
        'success' => true,
        'data' => $data
    ]);
}


}
