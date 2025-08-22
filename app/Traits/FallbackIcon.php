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
            // Use fallback if empty
            if (!$value) {
                return asset($this->fallbackFields[$key]);
            }

            // If value already looks like a URL (starts with http/https or /), don't prepend uploads
            if (filter_var($value, FILTER_VALIDATE_URL) || str_starts_with($value, '/')) {
                return asset($value);
            }

            // Otherwise prepend uploads
            return asset('/uploads/' . ltrim($value, '/'));
        }

        return $value;
    }
}
