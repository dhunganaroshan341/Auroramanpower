<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerProfile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bio', 'skills', 'experience', 'education', 'resume_file'];

    // Each jobseeker belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each jobseeker can have many applications
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_seeker_profile_id');
    }

      // ✅ FIX: use the correct relationship name
    public function hasAppliedTo($jobId)
    {
        return $this->applications()->where('job_id', $jobId)->exists();
    }
}
