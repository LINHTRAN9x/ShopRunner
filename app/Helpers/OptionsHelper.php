<?php
namespace App\Helpers;

class OptionsHelper
{
//    public static function generateOptions($collection, $selectedItem = null, $indent = 0): string
//    {
//        $options = '';
//
//        foreach ($collection as $item) {
//            $attributes = ($selectedItem && $item->id == $selectedItem->id) ? 'selected'.' disabled' : ''; // Check if current option matches the selected category's parent_id
//
//            $options .= '<option value="' . $item->id . '" ' . $attributes . '>' . str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $indent) . $item->name . '</option>';
//            if ($item->children()->count() > 0) {
//                $options .= self::generateOptions($item->children, $selectedItem, $indent + 1);
//            }
//        }
//        return $options;
//    }
//    public static function generateOptions($collection, $selectedItem = null, $indent = 0): string
//    {
//        $options = '';
//
//        foreach ($collection as $item) {
//            // Check if current option is the selected item or its child
//            $isSelectedOrChild = $selectedItem && ($item->id == $selectedItem->id || $selectedItem->isDescendantOf($item));
//
//            // Determine attributes based on selection
//            $attributes = $isSelectedOrChild ? 'disabled' : '';
//            if ($isSelectedOrChild && $item->id == $selectedItem->id) {
//                $attributes .= ' selected';
//            }
//
//            // Generate option HTML
//            $options .= '<option value="' . $item->id . '" ' . $attributes . '>' . str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $indent) . $item->name . '</option>';
//
//            // Recursively generate options for children
//            if ($item->children()->count() > 0) {
//                $options .= self::generateOptions($item->children, $selectedItem, $indent + 1);
//            }
//        }
//        return $options;
//    }
//    public static function generateOptions($collection, $selectedItem = null, $indent = 0): string
//    {
//        $options = '';
//
//        foreach ($collection as $item) {
//            $attributes = '';
//
//            if ($selectedItem && $item->isDescendantOf($selectedItem)) {
//                $attributes .= 'disabled ';
//            }
//
//            if ($selectedItem && $item->id == $selectedItem->id) {
//                $attributes .= 'selected';
//            }
//
//            $options .= '<option value="' . $item->id . '" ' . $attributes . '>' . str_repeat('__', $indent) . $item->name . '</option>';
//
//            if ($item->children()->count() > 0) {
//                $options .= self::generateOptions($item->children, $selectedItem, $indent + 1);
//            }
//        }
//
//        return $options;
//    }
    public static function generateOptions($collection, $selectedItem = null, $indent = 0): string
    {
        $options = '';

        foreach ($collection as $item) {
            $attributes = '';

            if ($selectedItem && $item->isDescendantOf($selectedItem)) {
                $attributes .= 'disabled ';
            }

            $selected = $selectedItem && $item->id == $selectedItem->id ? 'selected' : '';
            $value = $selected ? $item->parent_id : $item->id;

            $options .= '<option value="' . $value . '" ' . $attributes . ' ' . $selected . '>' . str_repeat('__', $indent) . $item->name . '</option>';

            if ($item->children()->count() > 0) {
                $options .= self::generateOptions($item->children, $selectedItem, $indent + 1);
            }
        }

        return $options;
    }
    public static function generateCatOptions($collection, $theItem = null, $parentItem = null, $indent = 0): string
    {
        $options = '';

        foreach ($collection as $item) {
            $attributes = '';

            if ($theItem && $item->isDescendantOf($theItem)) {
                $attributes .= 'disabled ';
            }
            $value = $item->id;
            $selected = '';
//            if($theItem == null && $parentItem == null) {
//                $value = $item->id;
//            }
            // theItem is already parentCat when $parentItem == null
            if($theItem != null && $parentItem == null) {
                if($item->id == $theItem->id ) {
                    $selected = 'selected';
                    $value= 0;
                }
            }
            else if($theItem != null && $parentItem != null) {
                if ($item->id == $parentItem->id) {
                    $selected = 'selected';
                    $value = $parentItem->id;
                }
            }
            $options .= '<option value="' . $value . '" ' . $attributes . ' ' . $selected . '>' . str_repeat('__', $indent) . $item->name . '</option>';

            if ($item->children()->count() > 0) {
                $options .= self::generateCatOptions($item->children, $theItem, $parentItem, $indent + 1);
            }
        }

        return $options;
    }

    public static function generateOptionsWithSelected($collection, $selectedItems = [], $indent = 0): string
    {
        $options = '';
        $selectedItemIds = $selectedItems->pluck('id')->toArray();
        foreach ($collection as $item) {
            $attributes = '';

            // Check if the current $item is in the array of $selectedItems
            if (in_array($item->id, $selectedItemIds)) {
                $attributes .= 'selected ';
            }

            // Generate the HTML <option> element with appropriate attributes and indentation
            $options .= '<option value="' . $item->id . '" ' . $attributes . '>' . str_repeat('__', $indent) . $item->name . '</option>';

            // Recursively generate options for children if any
            if ($item->children()->count() > 0) {
                $options .= self::generateOptionsWithSelected($item->children, $selectedItems, $indent + 1);
            }
        }

        return $options;
    }


}
