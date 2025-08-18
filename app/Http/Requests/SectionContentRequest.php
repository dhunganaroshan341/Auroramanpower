<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
public function rules()
    {
        return [
            'section_category_id' => 'required|exists:section_categories,id',
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
                     'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:2048', // max size in KB

            'video' => 'nullable|string|max:255',
            'pdf' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'description' => 'nullable|string',
            'description2' => 'nullable|string',
            'icon_class' => 'nullable|string|max:255',
            'link_title' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
        ];
    }
}
