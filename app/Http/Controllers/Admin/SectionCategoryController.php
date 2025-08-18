<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionCategoryRequest;
use App\Models\SectionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SectionCategoryController extends Controller
{
    /**
     * Handle image upload and deletion logic.
     */
    private function handleImageUpload(Request $request, ?SectionCategory $category = null): ?string
    {
        if ($request->hasFile('image')) {
            // If updating and category already has an image, delete it first
            if ($category && $category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $path = 'images/section-category/';
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $store = $request->image->storeAs($path, $imageName, 'public');

            return $store;
        }

        return $category?->image; // keep old image if no new file uploaded
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = SectionCategory::query()->orderBy('id', 'desc');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-warning editCategoryBtn" data-id="' . $item->id . '">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger deleteCategoryBtn" data-id="' . $item->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $extraJs = array_merge(
            config('js-map.admin.datatable.script'),
            config('js-map.admin.summernote.script'),
            config('js-map.admin.buttons.script')
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style'),
            config('js-map.admin.buttons.style')
        );

        return view('Admin.pages.SectionCategory.sectionCategoryIndex', [
            'extraJs' => $extraJs,
            'extraCs' => $extraCs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionCategoryRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload
        $validated['image'] = $this->handleImageUpload($request);

        SectionCategory::create($validated);

        return response()->json(['success' => true, 'message' => 'Section Category created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = SectionCategory::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionCategoryRequest $request, string $id)
    {
        $validated = $request->validated();
        $category = SectionCategory::findOrFail($id);

        // Handle image replacement
        $validated['image'] = $this->handleImageUpload($request, $category);

        $category->update($validated);

        return response()->json(['success' => true, 'message' => 'Section Category updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = SectionCategory::findOrFail($id);

        // Delete image file if exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return response()->json(['success' => true, 'message' => 'Section Category deleted successfully.']);
    }
}
