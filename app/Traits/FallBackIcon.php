<?php

namespace App\Traits;

trait FallbackIcon
{
    /**
     * Array of columns that should have fallback icons.
     * Example: ['image' => '/user.png', 'avatar' => '/default-avatar.png']
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
            return $value ? asset($value) : asset($this->fallbackFields[$key]);
        }

        return $value;
    }
}
