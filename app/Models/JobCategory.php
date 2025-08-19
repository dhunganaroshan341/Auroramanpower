<?php

namespace App\Models;

use App\Traits\HasImageUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobCategory extends Model
{
    use HasFactory;
     use HasImageUrl;

    // Optional: if you want multiple image fields dynamically
    protected $imageFields = ['image'];

    protected $fillable = ['name', 'description','slug','image','icon_class']; // adjust fields

    /**
     * The jobs that belong to this category.
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_category_job', 'job_category_id', 'job_id')
                    ->withTimestamps();
    }
      protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
}
