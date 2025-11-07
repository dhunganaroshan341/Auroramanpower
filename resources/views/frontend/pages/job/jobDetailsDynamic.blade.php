@dd(auth()->user()->jobSeekerProfile->id);

@dd(\App\Models\Application::where('job_id', $job->id)
    ->where('job_seeker_id', auth()->user()->jobSeekerProfile->id)
    ->exists());
