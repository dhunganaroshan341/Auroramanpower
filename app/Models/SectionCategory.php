<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'sub_heading',
        'image',
        'video',
        'slug',
        'description',
        'description2',
    ];

    public function sectionContents()
    {
        return $this->hasMany(SectionContent::class);
    }

    /**
     * Accessor for the image attribute
     * Automatically prepends the asset URL.
     */
    public function getImageAttribute($value)
    {
        if ($value) {
            return asset($value); // returns full URL
        }
        return null; // no image uploaded
    }
}
