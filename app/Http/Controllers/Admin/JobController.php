<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class JobController extends Controller
{
    /**
     * Display a listing of jobs under a specific vacancy.
     */
public function index(Request $request)
{
    if ($request->ajax()) {
        $jobs = Job::with(['employer', 'categories', 'ourCountry'])->latest();

        return datatables()->eloquent($jobs)
            ->addIndexColumn()
            ->addColumn('action', function ($job) {
                return view('Admin.Button.button', ['data' => $job])->render();
            })
            ->addColumn('image', function ($job) {
                $image = $job->image_url ?? asset('uploads/' . $job->image);
                $defaultImage = asset('user.png');
                return '<img src="' . $image . '" width="50" height="50"
                         class="rounded" style="object-fit:cover"
                         onerror="this.src=\'' . $defaultImage . '\'"/>';
            })
            ->addColumn('status', function ($job) {
                $checked = strtolower($job->status) === 'active' ? 'checked' : '';
                return '<div class="form-check form-switch text-center">
                    <input class="form-check-input statusIdData"
                           type="checkbox" data-id="' . $job->id . '" role="switch" ' . $checked . '>
                </div>';
            })
            ->addColumn('employer', function ($job) {
                return optional($job->employer)->name ?? '<em>Not Assigned</em>';
            })
            ->addColumn('our_country', function ($job) {
                // Send country name directly
                return optional($job->ourCountry)->name ?? '<em>Not Set</em>';
            })
            ->addColumn('categories', function ($job) {
                if ($job->categories->isEmpty()) {
                    return '<em>No Categories</em>';
                }
                return $job->categories->pluck('name')->map(function ($name) {
                    return '<span class="badge bg-primary me-1">' . e($name) . '</span>';
                })->implode(' ');
            })
            ->rawColumns(['action', 'image', 'status', 'employer', 'our_country', 'categories'])
            ->orderColumns(['title', 'employer.name', 'salary', 'status'], ':column $1')
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

    return view('Admin.pages.Job.jobIndex', [
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
}
