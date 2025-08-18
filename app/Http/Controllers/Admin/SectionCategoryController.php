<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionCategoryRequest;
use App\Models\SectionCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\HandlesImage;

class SectionCategoryController extends Controller
{
    use HandlesImage;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = SectionCategory::query()->orderBy('id', 'desc');

            return DataTables::of($query)
                ->addIndexColumn()
                 ->addColumn('image', function ($item) {
                    $dataimage =   $item->image;
                    $defaultImage=asset('user.png');
                    return ' <td class="py-1">
                    <img src="' . $dataimage . '" width="50" height="50" onerror="this.src=\''.$defaultImage.'\'"/>
                    </td>';
                })
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
                ->rawColumns(['action','image'])
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
        $data = $request->validated();
        $data['image'] = $this->uploadSingleImage($request, 'image', 'uploads/section-category');

        SectionCategory::create($data);

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
        $category = SectionCategory::findOrFail($id);
        $data = $request->validated();
        $data['image'] = $this->uploadSingleImage($request, 'image', 'uploads/section-category', $category);

        $category->update($data);

        return response()->json(['success' => true, 'message' => 'Section Category updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = SectionCategory::findOrFail($id);

        // Delete image manually
        if ($category->image && file_exists(public_path($category->image))) {
            @unlink(public_path($category->image));
        }

        $category->delete();

        return response()->json(['success' => true, 'message' => 'Section Category deleted successfully.']);
    }
}
