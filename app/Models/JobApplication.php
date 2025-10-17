<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'job_seeker_profile_id',
        'name',
        'email',
        'phone',
        'resume_file',
        'bio',
        'desired_role',
        'status'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function jobSeekerProfile()
    {
        return $this->belongsTo(JobSeekerProfile::class, 'job_seeker_profile_id');
    }
}
