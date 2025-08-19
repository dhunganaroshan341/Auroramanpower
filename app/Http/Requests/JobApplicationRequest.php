<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // change if you want only certain users to apply/manage
    }

    public function rules(): array
    {
        return [
            'job_id'        => 'required|exists:jobs,id',
            'job_seeker_id' => 'required|exists:job_seeker_profiles,id',
            'cover_letter'  => 'nullable|string',
            'status'        => 'nullable|in:applied,shortlisted,rejected',
        ];
    }

    public function messages(): array
    {
        return [
            'job_id.required'        => 'Job selection is required.',
            'job_id.exists'          => 'Selected job is invalid.',
            'job_seeker_id.required' => 'Job seeker selection is required.',
            'job_seeker_id.exists'   => 'Selected job seeker is invalid.',
            'status.in'              => 'Invalid status value.',
        ];
    }
}
