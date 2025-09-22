<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    if ($request->ajax()) {
        $jobs = Job::query();

        return DataTables::eloquent($jobs)
            ->addIndexColumn() // DT_RowIndex
            ->addColumn('action', function ($data) {
                return view('Admin.Button.button', compact('data'))->render();
            })
            ->addColumn('image', function ($item) {
                $dataimage = asset('uploads/' . $item->image);
                $defaultImage = asset('defaultImage/defaultimage.webp');
                return '<img src="' . $dataimage . '" width="50" height="50" onerror="this.src=\'' . $defaultImage . '\'"/>';
            })
            ->addColumn('status', function ($status) {
                $checked = $status->status === 'Active' ? 'checked' : '';
                return '<div class="form-check form-switch">
                    <input class="form-check-input statusIdData d-flex mx-auto"
                           type="checkbox" data-id="' . $status->id . '" role="switch" ' . $checked . '>
                </div>';
            })
            ->rawColumns(['action', 'image', 'status'])
            ->make(true);
    }

    // Extra JS & CSS files
    $extraJs = array_merge(
        config('js-map.admin.datatable.script'),
        config('js-map.admin.summernote.script'),
        // config('js-map.admin.buttons.script')
    );

    $extraCs = array_merge(
        config('js-map.admin.datatable.style'),
        config('js-map.admin.summernote.style'),
        // config('js-map.admin.buttons.style')
    );

    return view('Admin.pages.Job.jobIndex', [
        'extraJs' => $extraJs,
        'extraCs' => $extraCs
    ]);
}



    /**
     * Store a newly created resource in storage.
     */
 public function store(JobRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Handle image upload
            $data['image'] = $this->uploadSingleImage($request, 'image', 'uploads/jobs');

            // Create job
            $job = Job::create($data);

            // Attach job categories
            if ($request->has('category_ids')) {
                $job->categories()->attach($request->category_ids);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Job created successfully!', 'data' => $job]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display a specific job with categories.
     */
    public function show(string $id)
    {
        try {
            $job = Job::with('categories')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $job]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    /**
     * Update a specific job.
     */
    public function update(JobRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $job = Job::findOrFail($id);

            $data = $request->validated();

            // Handle image upload (will delete old if new uploaded)
            $data['image'] = $this->uploadSingleImage($request, 'image', 'uploads/jobs', $job);

            $job->update($data);

            // Sync categories
            if ($request->has('category_ids')) {
                $job->categories()->sync($request->category_ids);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Job updated successfully!', 'data' => $job]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a specific job.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $job = Job::findOrFail($id);

            // Detach categories
            $job->categories()->detach();

            // Delete image if exists
            if ($job->image && file_exists(public_path($job->image))) {
                @unlink(public_path($job->image));
            }

            $job->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Job deleted successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function toggleStatus($id)
    {
        $job = Job::findOrFail($id);
        $job->status = !$job->status;
        $job->save();

        return response()->json(['success' => true, 'message' => 'Status updated.']);
    }

}
