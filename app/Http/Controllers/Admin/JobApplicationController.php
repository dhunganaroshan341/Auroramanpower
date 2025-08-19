<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationRequest;
use App\Models\Application;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search.value');
            $columns = $request->input('columns');
            $order = $request->input('order')[0];
            $orderColumnIndex = $order['column'];
            $orderBy = $order['dir'];

            $applicationsQuery = Application::with(['job', 'jobSeeker']);

            // Filtering search
            if ($search) {
                $applicationsQuery->where(function ($query) use ($search) {
                    $query->whereHas('job', fn($q) => $q->where('title', 'LIKE', "%$search%"))
                          ->orWhereHas('jobSeeker', fn($q) => $q->where('name', 'LIKE', "%$search%"))
                          ->orWhere('cover_letter', 'LIKE', "%$search%")
                          ->orWhere('status', 'LIKE', "%$search%");
                });
            }

            $orderColumnName = $columns[$orderColumnIndex]['data'] ?? 'created_at';
            $applicationsQuery->orderBy($orderColumnName, $orderBy);

            return DataTables::eloquent($applicationsQuery)
                ->addIndexColumn()
                ->addColumn('job_title', fn($item) => optional($item->job)->title ?? '-')
                ->addColumn('job_seeker', fn($item) => optional($item->jobSeeker)->name ?? '-')
                ->addColumn('status', function ($item) {
                    return '<select class="form-select application-status" data-id="' . $item->id . '">
                                <option value="applied" ' . ($item->status == 'applied' ? 'selected' : '') . '>Applied</option>
                                <option value="shortlisted" ' . ($item->status == 'shortlisted' ? 'selected' : '') . '>Shortlisted</option>
                                <option value="rejected" ' . ($item->status == 'rejected' ? 'selected' : '') . '>Rejected</option>
                            </select>';
                })
                ->addColumn('action', fn($data) => view('Admin.Button.button', compact('data')))
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('Admin.pages.application.index');
    }

    public function store(JobApplicationRequest $request)
    {
        $application = Application::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully!',
            'data' => $application
        ]);
    }

    public function update(JobApplicationRequest $request, string $id)
    {
        $application = Application::findOrFail($id);
        $application->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Application updated successfully!',
            'data' => $application
        ]);
    }

    public function manageStatus(string $id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:applied,shortlisted,rejected'
        ]);

        $application = Application::findOrFail($id);
        $application->status = $request->status;
        $application->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
            'data' => $application
        ]);
    }

    public function destroy(string $id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'Application deleted successfully!'
        ]);
    }
}
