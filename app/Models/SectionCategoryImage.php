<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionCategoryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_category_id',
        'image',
    ];

    public function sectionCategory()
    {
        return $this->belongsTo(SectionCategory::class);
    }
    public function getImageAttribute($value)
{
    if ($value) {
        // Remove "admin/" if it appears anywhere in the beginning
        $cleanPath = preg_replace('#^admin/#', '', $value);

        // Return the full URL using Laravel's asset() helper
        return asset($cleanPath);
    }

    return null;
}

}
