<?php

namespace App\Traits;

trait FallbackIcon
{
    /**
     * Columns with their fallback paths
     *
     * @var array
     */
    protected $fallbackFields = [];

    /**
     * Define a fallback for a field
     *
     * @param string $field
     * @param string $fallbackPath
     */
    public function fallbackField(string $field, string $fallbackPath = '/user.png')
    {
        $this->fallbackFields[$field] = $fallbackPath;
    }

    /**
     * Override the getAttribute method
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (array_key_exists($key, $this->fallbackFields)) {
            if ($value) {
                // If value exists, prepend uploads/ and wrap with asset()
                return asset('uploads/' . ltrim($value, '/'));
            } else {
                // Use fallback
                return asset($this->fallbackFields[$key]);
            }
        }

        return $value;
    }
}
