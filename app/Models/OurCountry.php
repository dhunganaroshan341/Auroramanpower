<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurCountry extends BaseModel
{
    use HasFactory;
      protected $fillable = [
        'name',
        'slug',
        'description',
    ];
    protected $table = 'our_countries';
    protected $id = 'id';
    public function jobs()
    {
        return $this->hasMany(Job::class, 'our_country_id');
    }


}
