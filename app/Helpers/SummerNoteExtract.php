<?php

namespace App\Helpers;

use App\Helpers\ImageUploadHelper;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Adjust the namespace for Request

class SummerNoteExtract
{
//    public static function extractSummerNote(Request $request)
//    {
//        try {
//            $description = $request->description;
//            if ($description) {
//                $dom = new DOMDocument();
//                // Load HTML content with error handling
//                if (@$dom->loadHTML($description)) {
//                    // Suppress errors and warnings for loading HTML
//                    $images = $dom->getElementsByTagName('img');
//                    foreach ($images as $key => $img) {
//                        // Extract image source attribute
//                        $src = $img->getAttribute('src');
//                        // Check if the image source is a data URI
//                        if (strpos($src, 'data:image') === 0) {
//                            // Extract base64-encoded image data
//                            $data = base64_decode(explode(',', explode(';', $src)[1])[1]);
//                            // Upload the image and get image details
//                            $imageDetails = ImageUploadHelper::uploadImage($data, "products/$request->name/summernoteImages");
//                            // Check if image upload was successful
//                            if (!empty($imageDetails)) {
//                                // Update image source in HTML to the public path
//                                $img->setAttribute('src', asset($imageDetails['imagePath']));
//                            } else {
//                                // Error uploading image
//                                // Handle error (e.g., log error, display error message)
//                            }
//                        }
//                    }
//                    // Get updated HTML content
//                    $processedDescription = $dom->saveHTML();
//                    // Further processing or saving of the HTML content
//                    return $processedDescription; // Return the processed HTML content
//                } else {
//                    // Error loading HTML
//                    // Handle error (e.g., log error, display error message)
//
//                }
//            }
//        } catch (\Exception $e) {
//            // Log the error message along with file and line information
//            Log::error('An error occurred: ' . $e->getMessage() . ' in ' . $e->getFile() . ' at line ' . $e->getLine());
//            // Optionally, rethrow the exception to let Laravel's error handling continue
//            throw $e;
//        }
//
//        return $description; // Return original description if no changes were made
//    }


    public static function extractSummerNote(Request $request)
    {
        try {
            $description = $request->description;
            if ($description) {
                $dom = new DOMDocument();
                $dom->encoding = 'utf-8';
                // Load HTML content with error handling
//                $dom->loadHTML(mb_encode_numericentity($profile, [0x80, 0x10FFFF, 0, ~0], 'UTF-8'));
                if (@$dom->loadHTML(mb_encode_numericentity($description, [0x80, 0x10FFFF, 0, ~0], 'UTF-8'))) {
                    // Suppress errors and warnings for loading HTML
                    $images = $dom->getElementsByTagName('img');
                    foreach ($images as $key => $img) {
                        // Extract image source attribute
                        $src = $img->getAttribute('src');
                        // Check if the image source is a data URI
                        if (strpos($src, 'data:image') === 0) {
                            // Extract base64-encoded image data
                            $data = base64_decode(explode(',', explode(';', $src)[1])[1]);
                            // Upload the image and get image details
                            $imageDetails = ImageUploadHelper::uploadImage($data, "products/$request->name/summernoteImages");
                            // Check if image upload was successful
                            if (!empty($imageDetails)) {
                                // Update image source in HTML to the public path
                                $img->setAttribute('src', asset($imageDetails['imagePath']));
                            } else {
                                // Error uploading image
                                // Handle error (e.g., log error, display error message)
                            }
                        }elseif (strpos($src, '/storage/') !== false) {
                            // Image source is a URL pointing to the storage directory
                            // Retrieve the image data using the Storage facade
                            $path = str_replace('/storage/', 'public/', parse_url(urldecode($src), PHP_URL_PATH));
//                            dd($path);
                            $data = Storage::disk('local')->get($path);
                            // Upload the image and get image details
                            $imageDetails = ImageUploadHelper::uploadImage($data, "products/{$request->name}/summernoteImages");
//                            dd($imageDetails);
                            // Check if image upload was successful
                            if (!empty($imageDetails)) {
                                // Store the binary image data in the image details
                                $imageDetails['binaryData'] = $data;
                                // Update image source in HTML to the public path
                                $img->setAttribute('src', asset($imageDetails['imagePath']));
                            } else {
                                // Error uploading image
                                // Handle error (e.g., log error, display error message)
                            }
                        }

                    }
                    // Get updated HTML content
                    // Convert HTML content to UTF-8 encoding

                    // Further processing or saving of the HTML content
                    return $dom->saveHTML(); // Return the processed HTML content
                } else {
                    // Error loading HTML
                    // Handle error (e.g., log error, display error message)

                }
            }
        } catch (\Exception $e) {
            // Log the error message along with file and line information
            Log::error('An error occurred: ' . $e->getMessage() . ' in ' . $e->getFile() . ' at line ' . $e->getLine());
            // Optionally, rethrow the exception to let Laravel's error handling continue
            throw $e;
        }

        return $description; // Return original description if no changes were made
    }


}
