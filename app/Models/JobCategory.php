<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description']; // adjust fields

    /**
     * The jobs that belong to this category.
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_category_job', 'job_category_id', 'job_id')
                    ->withTimestamps();
    }
}
                                                