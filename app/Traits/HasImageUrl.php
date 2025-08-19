<?php

namespace App\Traits;

trait HasImageUrl
{
    /**
     * Boot the trait and dynamically add the getImageAttribute accessor
     */
    public static function bootHasImageUrl()
    {
        static::retrieved(function ($model) {
            if (property_exists($model, 'imageFields')) {
                foreach ($model->imageFields as $field) {
                    // dynamically add accessor
                    $model->append($field . '_url');
                }
            }
        });
    }

    /**
     * Generic accessor for any image field
     * Returns full URL if exists, null otherwise
     */
    public function getImageUrlAttribute()
    {
        if (isset($this->attributes['image']) && $this->attributes['image']) {
            return asset($this->attributes['image']);
        }
        return null;
    }

    /**
     * Optional: generic method for multiple image fields
     */
    public function getImageFieldUrl(string $field)
    {
        if (isset($this->{$field}) && $this->{$field}) {
            return asset($this->{$field});
        }
        return null;
    }
}
