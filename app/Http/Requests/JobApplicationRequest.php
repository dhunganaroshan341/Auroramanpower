<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // If you want only authenticated users, return auth()->check()
        // For manual applications, everyone can submit
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'resume_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'desired_role' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Your full name is required.',
            'email.required' => 'Email is required.',
            'phone.required' => 'Phone number is required.',
            'resume_file.required' => 'Please upload your CV.',
            'resume_file.mimes' => 'Accepted formats: PDF, DOC, DOCX.',
            'desired_role.required' => 'Specify the position you are applying for.',
        ];
    }
}
