<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class PostRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'post_title' => 'required|min:3',
            'post_images' => $this->route('id') ? 'array' : 'required|array',
            'post_images.*' => 'mimes:png,jpeg,jpg,webp',
            'post_description' => 'required',

            // Multiple category IDs
            'category_ids' => 'required|array',
            'category_ids.*' => 'required|exists:categories,id',

            // Multiple tag IDs (optional)
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'integer|exists:tags,id',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages()
    {
        return [
            'post_title.required' => 'Please enter the title',
            'post_title.min' => 'Title should be at least 3 characters',
            'post_images.required' => 'Please insert at least one image',
            'post_images.*.mimes' => 'Image should be of type: png, jpeg, jpg, webp',
            'post_description.required' => 'Please enter the description',

            'category_ids.required' => 'Please select at least one category',
            'category_ids.*.exists' => 'Selected category is invalid',

            'tag_ids.*.exists' => 'Selected tag is invalid',
        ];
    }

    /**
     * Get valid category options (if needed elsewhere)
     */
    public function getCategoryOptions(): array
    {
        return DB::table('categories')->pluck('id')->toArray();
    }
}
