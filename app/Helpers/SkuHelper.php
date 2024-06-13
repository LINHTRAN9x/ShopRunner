<?php

namespace App\Helpers;

class SkuHelper
{
    public static function generateSKU($id, $productName, $size) {
        // Remove any non-alphanumeric characters from product name and convert to lowercase
        $productNameClean = preg_replace('/[^a-zA-Z0-9 ]+/', '', $productName);
        $productNameClean = strtolower($productNameClean);

        // Split product name by space and take the first letter of each word
        $productNameParts = explode(' ', $productNameClean);
        $productNameAbbreviated = '';
        foreach ($productNameParts as $part) {
            $productNameAbbreviated .= substr($part, 0, 1);
        }

        // Generate a UUID
        $uuid = uniqid();

        // Ensure size is lowercase
        $size = strtolower($size);

        // Concatenate parts to form SKU
//        $sku = $id . $productNameAbbreviated . $uuid . $size;
        $sku = $id . $productNameAbbreviated. $size;
        $sku = strtoupper($sku);
        return $sku;
    }


}
