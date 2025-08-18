<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionCategoryRequest;
use App\Models\SectionCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SectionCategoryController extends Controller
{
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

        return view('Admin.pages.SectionCategory.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionCategoryRequest $request)
    {
        $validated = $request->validated();
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
        $category->update($validated);

        return response()->json(['success' => true, 'message' => 'Section Category updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = SectionCategory::findOrFail($id);
        $category->delete();

        return response()->json(['success' => true, 'message' => 'Section Category deleted successfully.']);
    }
}
