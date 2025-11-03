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
    public function fallbackField(string $field, string $fallbackPath = '/fallbackimage.webp')
    {
        $this->fallbackFields[$field] = $fallbackPath;
    }

    /**
     * Override getAttribute to handle fallbacks automatically
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (array_key_exists($key, $this->fallbackFields)) {
            // If value is missing or empty
            if (empty($value)) {
                return asset(ltrim($this->fallbackFields[$key], '/'));
            }

            // If value is already a full URL
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                return $value;
            }

            // If value starts with '/', treat as relative to public root
            if (str_starts_with($value, '/')) {
                return asset(ltrim($value, '/'));
            }

            // Otherwise, prepend uploads/ if not already included
            if (!str_starts_with($value, 'uploads/')) {
                $value = 'uploads/' . ltrim($value, '/');
            }

            return asset($value);
        }

        return $value;
    }
}
