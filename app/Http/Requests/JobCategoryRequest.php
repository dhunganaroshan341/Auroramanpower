<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Change if only certain users can manage categories
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon_class'  => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'slug'        => 'required|string|max:255|unique:job_categories,slug,' . $this->id,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required.',
            'slug.required' => 'Slug is required.',
            'slug.unique'   => 'This slug is already in use.',
            'image.image'   => 'The file must be an image.',
            'image.mimes'   => 'Allowed formats: jpeg, png, jpg, gif, svg.',
        ];
    }
}
