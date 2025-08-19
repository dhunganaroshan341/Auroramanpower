<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Change to logic if you want permission checks
    }

    public function rules()
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'location'    => 'nullable|string|max:255',
            'salary'      => 'nullable|numeric|min:0',
            'our_country_id' => 'nullable|exists:our_countries,id',
            'employer_id' => 'nullable|exists:employers,id', // if optional
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:job_categories,id', // validate each category
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The job title is required.',
            'description.required' => 'Please provide a job description.',

        ];
    }
}
