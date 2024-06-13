<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadHelper
{
    public static function uploadImage($image, $folderName = ''): array
    {
        try {
            // Check if the image is null
            if (!$image) {
                return [
                    'originName' => null,
                    'imagePath' => null,
                    'imageName' => null,
                ];
            }

            $folderName ? $folderName.= '/': $folderName = '';
            // Determine if the input is base64-encoded image data
            $isBase64 = is_string($image);

            // Generate a unique image name based on the input type
            $imageName = $isBase64 ? time() . '_' . Str::random(10) . '.png' : time() . '_' . $image->getClientOriginalName();

            // Store the image in the specified folder
            $imagePath = $isBase64 ? 'public/' . $folderName . $imageName : $image->storeAs('public/' . $folderName, $imageName);
            $imagePath = self::trimExtraSlashes($imagePath);
            if (!$imagePath) {
                throw new \Exception("Failed to store the image.");
            }

            // Create the public image path

            $publicImagePath = Storage::url($imagePath);

            // If it's base64-encoded, store the image directly; otherwise, use the storage system
            if ($isBase64) {
                Storage::put($imagePath, $image);
            }

            // Return an array with image details
            return [
                'originName' => $isBase64 ? $imageName : $image->getClientOriginalName(),
                'imagePath' => $publicImagePath,
                'imageName' => $imageName,
            ];
        } catch (\Exception $e) {
            // Log the error message along with file and line information
            Log::error('An error occurred: ' . $e->getMessage() . ' in ' . $e->getFile() . ' at line ' . $e->getLine());
            // Optionally, rethrow the exception to let Laravel's error handling continue
            throw $e;
        }
    }

    public static function trimExtraSlashes($path)
    {
        return preg_replace('#/+#', '/', $path);
    }
}
