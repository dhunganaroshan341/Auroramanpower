<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HandlesImage
{
    /**
     * Handle single image upload using public_path.
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

        return $existingModel ? $existingModel->{$fieldName} : null;
    }

    /**
     * Handle multiple images upload using public_path.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $fieldName
     * @param string $folderPath
     * @return array
     */
    public function uploadMultipleImages(Request $request, string $fieldName, string $folderPath): array
    {
        $paths = [];

        if ($request->hasFile($fieldName)) {
            $files = $request->file($fieldName);

            // Make sure folder exists
            $destination = public_path($folderPath);
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            foreach ($files as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($destination, $fileName);
                $paths[] = $folderPath . '/' . $fileName;
            }
        }

        return $paths;
    }
}
