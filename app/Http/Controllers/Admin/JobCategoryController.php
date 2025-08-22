<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobCategoryRequest;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Traits\HandlesImage;
use Yajra\DataTables\Facades\DataTables;

class JobCategoryController extends Controller
{
    use HandlesImage;

    /**
     * Display a listing of the resource (Datatable)
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = JobCategory::query();

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('image', function ($item) {
                    $image = $item->image ? asset($item->image) : asset('/user.png');
                    return '<td class="py-1">
                                <img src="' . $image . '" width="50" height="50" onerror="this.src=\'' . asset('defaultImage/defaultimage.webp') . '\'"/>
                            </td>';
                })
                ->addColumn('action', function ($data) {
                    return view('Admin.Button.button', compact('data'));
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
$extraJs = array_merge(
            config('js-map.admin.datatable.script'),
            config('js-map.admin.summernote.script'),
            config('js-map.admin.buttons.script'),
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style'),
            config('js-map.admin.buttons.style'),
        );
        return view('Admin.pages.JobCategory.jobCategoryIndex',compact('extraJs','extraCs'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(JobCategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->uploadSingleImage($request, 'image', 'uploads/job-category');

            $category = JobCategory::create($data);

            return response()->json(['success' => true, 'message' => 'Category created successfully', 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource
     */
    public function show(string $id)
    {
        try {
            $category = JobCategory::findOrFail($id);
            return response()->json(['success' => true, 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage
     */
    public function update(JobCategoryRequest $request, string $id)
    {
        try {
            $category = JobCategory::findOrFail($id);
            $data = $request->validated();

            // Handle image upload
            $data['image'] = $this->uploadSingleImage($request, 'image', 'uploads/job-category', $category);

            $category->update($data);

            return response()->json(['success' => true, 'message' => 'Category updated successfully', 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(string $id)
    {
        try {
            $category = JobCategory::findOrFail($id);

            // Delete image if exists
            if ($category->image) {
                @unlink(public_path($category->image));
            }

            $category->delete();

            return response()->json(['success' => true, 'message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function toggleStatus($id)
    {
        $job = JobCategory::findOrFail($id);
        $job->status = !$job->status;
        $job->save();

        return response()->json(['success' => true, 'message' => 'Status updated.']);
    }
}
