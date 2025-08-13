<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageBookingRequest extends FormRequest
{
    /**
     * Allow all users to submit the request (can restrict later if needed)
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define validation rules that match your `package_bookings` table
     */
    public function rules(): array
{
    return [
        'user_id'         => 'nullable|exists:users,id',
        'email'           => 'nullable|email|max:255',
        'name'           => 'nullable|string|max:255',
        'message'         => 'nullable|string',
        'phone' => [
            'nullable',
            'string',
            'max:20',
            'regex:/^\+?[0-9\s\-]{7,20}$/'
        ],
        'country'         => 'nullable|string|max:100',

        'children'        => 'nullable|integer|min:0',
        'adult'           => 'nullable|integer|min:0',
        'total_people'    => 'nullable|integer|min:1',
        'price'           => 'nullable|numeric|min:0',

        'tour_package_id' => 'nullable|exists:tour_packages,id',
        'tour_batch_id'   => 'nullable|exists:tour_batches,id',
        'custom_date'     => 'nullable|date|after_or_equal:today',

        'booking_type'    => 'required|in:batch,custom',
        'status'          => 'in:pending,confirmed,cancelled,active,inactive',
    ];}
    public function messages(): array
{
    return [
        'custom_date.after_or_equal' => 'Custom date must be today or a future date.',
        'phone.regex' => 'Phone number format is invalid. Only digits, spaces, dashes, and an optional leading + are allowed.',
    ];
}

}
