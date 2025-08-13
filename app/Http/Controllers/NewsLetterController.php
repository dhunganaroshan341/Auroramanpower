<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

  public function subscribe(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $email = $request->email;

    // Check if already subscribed
    $exists = NewsletterSubscriber::where('email', $email)->exists();

    if ($exists) {
        return response()->json([
            'message' => 'You are already subscribed!'
        ], 409);  // 409 Conflict status code
    }

    // If not subscribed, save it
    NewsletterSubscriber::create(['email' => $email]);

    return response()->json([
        'message' => 'Thank you for subscribing!'
    ]);
}
}
