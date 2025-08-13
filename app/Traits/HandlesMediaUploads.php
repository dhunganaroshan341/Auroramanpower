<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HandlesMediaUploads
{
    public function handleMediaUploads($request, $existingData = [], $folder = 'uploads/admin/pages')
    {
        $data = [];
        $publicFolderPath = public_path($folder);

        // Make sure directory exists
        if (!file_exists($publicFolderPath)) {
            mkdir($publicFolderPath, 0755, true);
        }

        // Helper function to delete old file
        $deleteOldFile = function ($filePath) {
            if ($filePath) {
                $fullPath = public_path($filePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        };

        // Helper function to save file and return relative path
        $saveFile = function (UploadedFile $file) use ($publicFolderPath, $folder) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($publicFolderPath, $filename);
            return $folder . '/' . $filename; // Relative path for DB
        };

        // Handle image_1
        if ($request->hasFile('image_1') && $request->file('image_1') instanceof UploadedFile) {
            $deleteOldFile($existingData['image_1'] ?? null);
            $data['image_1'] = $saveFile($request->file('image_1'));
        }

        // Handle image_2
        if ($request->hasFile('image_2') && $request->file('image_2') instanceof UploadedFile) {
            $deleteOldFile($existingData['image_2'] ?? null);
            $data['image_2'] = $saveFile($request->file('image_2'));
        }

        // Handle video_1
        if ($request->hasFile('video_1') && $request->file('video_1') instanceof UploadedFile) {
            $deleteOldFile($existingData['video_1'] ?? null);
            $data['video_1'] = $saveFile($request->file('video_1'));
        }

        // Handle video_2
        if ($request->hasFile('video_2') && $request->file('video_2') instanceof UploadedFile) {
            $deleteOldFile($existingData['video_2'] ?? null);
            $data['video_2'] = $saveFile($request->file('video_2'));
        }

        return $data;
    }
}
