<?php
// app/Models/BaseModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class BaseModel extends Model
{
    protected array $imageFields = ['image'];

   public function __get($key)
{
    $value = parent::__get($key);

    if (in_array($key, $this->getImageFields()) && is_string($value)) {
        // If $value already a full URL, return as-is
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return str_starts_with($value, 'uploads/')
            ? asset($value)
            : asset('uploads/' . $value);
    }

    return $value;
}


    protected function getImageFields(): array
    {
        return $this->imageFields;
    }

    // ✅ Enhanced uploadImage() with deletion flag
    public function uploadImage(UploadedFile $file, string $column = 'image', bool $deleteOld = true): void
    {
        if ($deleteOld && !empty($this->{$column}) && file_exists(public_path($this->{$column}))) {
            unlink(public_path($this->{$column}));
        }

        $folder = $this->uploadFolderPath();
        $path = $file->store($folder, 'uploads'); // uploads disk → public/uploads

        $this->{$column} = $path;
    }

    protected function uploadFolderPath(): string
    {
        $model = strtolower(class_basename($this));
        $date = now()->format('Y/m');
        return "{$model}s/{$date}";
    }
}
