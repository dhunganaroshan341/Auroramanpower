<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class VacancyController extends Controller
{

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
        config('js-map.admin.buttons.script')
    );

    $extraCs = array_merge(
        config('js-map.admin.datatable.style'),
        config('js-map.admin.summernote.style'),
        config('js-map.admin.buttons.style')
    );

    return view('Admin.pages.Job.jobIndex', [
        'extraJs' => $extraJs,
        'extraCs' => $extraCs
    ]);
}
    /**
     * Store a new vacancy along with multiple jobs.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate vacancy data
            $validatedVacancy = $request->validate([
                'company_id' => 'nullable|exists:clients,id',
                'custom_company_name' => 'nullable|string|max:255',
                'custom_company_country' => 'nullable|string|max:255',
                'title' => 'required|string|max:255',
                'currency' => 'nullable|string|max:10',
                'interview_date' => 'nullable|date',
                'general_requirements' => 'nullable|string',
                'description' => 'nullable|string',
                'status' => 'required|string|in:active,inactive',
                'vacancy_image' => 'nullable|image|max:2048',
                'jobs' => 'required|array|min:1',
                'jobs.*.title' => 'required|string|max:255',
                'jobs.*.description' => 'nullable|string',
                'jobs.*.location' => 'nullable|string|max:255',
                'jobs.*.salary' => 'nullable|string|max:255',
                'jobs.*.employer_id' => 'nullable|exists:employers,id',
                'jobs.*.status' => 'nullable|string|in:active,inactive',
                'jobs.*.category_ids' => 'nullable|array',
                'jobs.*.category_ids.*' => 'exists:categories,id',
                'jobs.*.image' => 'nullable|file|image|max:2048',
                'jobs.*.pdf' => 'nullable|file|mimes:pdf|max:4096',
            ]);

            // Handle vacancy image
            if ($request->hasFile('vacancy_image')) {
                $path = $request->file('vacancy_image')->store('uploads/vacancies', 'public');
                $validatedVacancy['vacancy_image'] = $path;
            }

            // Create vacancy
            $vacancy = Vacancy::create($validatedVacancy);

            // Store related jobs
            foreach ($validatedVacancy['jobs'] as $jobData) {
                if (isset($jobData['image']) && $jobData['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $jobData['image'] = $jobData['image']->store('uploads/jobs', 'public');
                }

                if (isset($jobData['pdf']) && $jobData['pdf'] instanceof \Illuminate\Http\UploadedFile) {
                    $jobData['pdf'] = $jobData['pdf']->store('uploads/job_pdfs', 'public');
                }

                $job = $vacancy->jobs()->create($jobData);

                if (isset($jobData['category_ids'])) {
                    $job->categories()->attach($jobData['category_ids']);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vacancy and its jobs created successfully!',
                'data' => $vacancy->load('jobs.categories'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update existing vacancy with jobs
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $vacancy = Vacancy::findOrFail($id);

            $validatedVacancy = $request->validate([
                'title' => 'required|string|max:255',
                'status' => 'required|string|in:active,inactive',
                'vacancy_image' => 'nullable|image|max:2048',
                'jobs' => 'nullable|array',
            ]);

            if ($request->hasFile('vacancy_image')) {
                if ($vacancy->vacancy_image && Storage::disk('public')->exists($vacancy->vacancy_image)) {
                    Storage::disk('public')->delete($vacancy->vacancy_image);
                }
                $validatedVacancy['vacancy_image'] = $request->file('vacancy_image')->store('uploads/vacancies', 'public');
            }

            $vacancy->update($validatedVacancy);

            if (!empty($validatedVacancy['jobs'])) {
                foreach ($validatedVacancy['jobs'] as $jobData) {
                    if (isset($jobData['id'])) {
                        $job = $vacancy->jobs()->find($jobData['id']);
                        if ($job) {
                            $job->update($jobData);
                            if (isset($jobData['category_ids'])) {
                                $job->categories()->sync($jobData['category_ids']);
                            }
                        }
                    } else {
                        $vacancy->jobs()->create($jobData);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vacancy updated successfully!',
                'data' => $vacancy->load('jobs.categories'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
