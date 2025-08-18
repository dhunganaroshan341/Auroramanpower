<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_category_id',
        'title',
        'short_description',
        'image',
        'video',
        'pdf',
        'description',
        'description2',
        'icon_class',
        'link_title',
        'link_url',
    ];

    public function sectionCategory()
    {
        return $this->belongsTo(SectionCategory::class);
    }
}
