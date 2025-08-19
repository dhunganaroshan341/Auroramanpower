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
}
