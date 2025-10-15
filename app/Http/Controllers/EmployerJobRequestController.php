<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployerJobRequest;

class EmployerJobRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = EmployerJobRequest::latest()->paginate(15); // Paginated
        return view('admin.employer_requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.pages.employer_request.create'); // Form view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname'           => 'required|string|max:255',
            'lname'           => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone'           => 'required|string|max:20',
            'company_name'    => 'required|string|max:255',
            'web_url'         => 'nullable|url|max:255',
            'industry'        => 'required|string|max:255',
            'location'        => 'required|string|max:255',
            'position'        => 'required|string|max:255',
            'openings'        => 'required|string|max:255',
            'salary_range'    => 'required|string|max:255',
            'job_description' => 'required|string',
        ]);

        EmployerJobRequest::create($validated);

       return response()->json([
        'status'  => 'success',
        'message' => 'Your request has been submitted successfully!'
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = EmployerJobRequest::findOrFail($id);
        return view('admin.employer_requests.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $request = EmployerJobRequest::findOrFail($id);
        return view('admin.employer_requests.edit', compact('request'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'fname'           => 'required|string|max:255',
            'lname'           => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone'           => 'required|string|max:20',
            'company_name'    => 'required|string|max:255',
            'web_url'         => 'nullable|url|max:255',
            'industry'        => 'required|string|max:255',
            'location'        => 'required|string|max:255',
            'position'        => 'required|string|max:255',
            'openings'        => 'required|string|max:255',
            'salary_range'    => 'required|string|max:255',
            'job_description' => 'required|string',
        ]);

        $requestRecord = EmployerJobRequest::findOrFail($id);
        $requestRecord->update($validated);

        return redirect()->route('employer-requests.index')->with('success', 'Request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $requestRecord = EmployerJobRequest::findOrFail($id);
        $requestRecord->delete(); // Hard delete. Can use soft deletes if preferred.
        return redirect()->route('employer-requests.index')->with('success', 'Request deleted successfully!');
    }
}
