<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HandlesImage
{
    /**
     * Handle single image upload using public_path.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $fieldName
     * @param  string  $folderPath  e.g., 'uploads/section-category'
     * @param  mixed|null  $existingModel
     * @return string|null
     */
    public function uploadSingleImage(Request $request, string $fieldName, string $folderPath, $existingModel = null): ?string
    {
        if ($request->hasFile($fieldName)) {

            // Delete old file if exists
            if ($existingModel && isset($existingModel->{$fieldName}) && file_exists(public_path($existingModel->{$fieldName}))) {
                @unlink(public_path($existingModel->{$fieldName}));
            }

            $file = $request->file($fieldName);
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destination = public_path($folderPath);

            // Make sure folder exists
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $fileName);

            return $folderPath . '/' . $fileName;
        }

        // Keep old image if updating and no new file uploaded
        return $existingModel ? $existingModel->{$fieldName} : null;
    }
}
