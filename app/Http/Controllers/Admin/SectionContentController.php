<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionContentRequest;
use App\Models\SectionContent;
use App\Models\SectionCategory;
use App\Traits\HandlesImage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SectionContentController extends Controller
{
     use HandlesImage;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = SectionContent::with('sectionCategory')->orderBy('id', 'desc');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('category', function ($item) {
                    return $item->sectionCategory ? $item->sectionCategory->title : '-';
                })
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
                            <button class="btn btn-sm btn-warning editContentBtn" data-id="' . $item->id . '">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger deleteContentBtn" data-id="' . $item->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }

        $categories = SectionCategory::all();
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
        //
        return view('Admin.pages.SectionContent.sectionContentIndex', ['categories'=>$categories,'extraJs' => $extraJs, 'extraCs' => $extraCs]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionContentRequest $request)
    {
        $validated = $request->validated();
        $validated['image'] = $this->uploadSingleImage($request, 'image', 'uploads/section-content');

        SectionContent::create($validated);

        return response()->json(['success' => true, 'message' => 'Section Content created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $content = SectionContent::with('sectionCategory')->findOrFail($id);
        return response()->json($content);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionContentRequest $request, string $id)
    {
        $validated = $request->validated();
        $content = SectionContent::findOrFail($id);
if($validated['image']!=null){
        $validated['image'] = $this->uploadSingleImage($request, 'image', 'uploads/section-content');

}
        $content->update($validated);

        return response()->json(['success' => true, 'message' => 'Section Content updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $content = SectionContent::findOrFail($id);
        $content->delete();

        return response()->json(['success' => true, 'message' => 'Section Content deleted successfully.']);
    }
}
