<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
     public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'sub_heading' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'video' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:section_categories,slug,' . $this->id,
            'description' => 'nullable|string',
            'description2' => 'nullable|string',
        ];
    }
}
