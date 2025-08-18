<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
   protected $fillable = [
        'employer_id',
        'title',
        'description',
        'requirements',
        'location',
        'salary',
        'status',
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
}
