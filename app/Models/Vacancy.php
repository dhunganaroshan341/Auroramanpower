<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'custom_company_name',
        'custom_company_country',
        'title',
        'currency',
        'interview_date',
        'general_requirements',
        'vacancy_image',
        'description',
        'status',
    ];

    /**
     * A vacancy can have multiple jobs.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Optional: Get the company info, whether existing or custom.
     */
    public function company()
    {
        return $this->belongsTo(Client::class);
    }
}
