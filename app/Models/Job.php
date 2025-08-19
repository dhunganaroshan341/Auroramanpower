<?php

namespace App\Models;

use App\Traits\HasImageUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model
{
     use HasImageUrl;protected $imageFields = ['image'];
   protected $fillable = [
        'employer_id',
        'title',
        'description',
        'requirements',
        'location',
        'salary',
        'status',
        'slug',
        'image',
        'pdf',
        'link',
        'icon_class',
        'our_country_id', // added field
    ];
    public function employer() {
        return $this->belongsTo(EmployerProfile::class, 'employer_id');
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }
        public function categories()
    {
        return $this->belongsToMany(JobCategory::class, 'job_category_job', 'job_id', 'job_category_id')
                    ->withTimestamps();
    }
    public function OurCountry(){
        return $this->belongsTo(OurCountry::class);
    }



    protected static function booted()
    {
        static::creating(function ($job) {
            $job->slug = Str::slug($job->title);
        });

        static::updating(function ($job) {
            $job->slug = Str::slug($job->title);
        });
    }
}
