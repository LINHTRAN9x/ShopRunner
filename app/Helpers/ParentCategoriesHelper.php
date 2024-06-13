<?php

namespace App\Helpers;

use App\Models\Category;

class ParentCategoriesHelper
{
    public static function returnParentCategories () {
        return Category::where('parent_id', 0)
            ->with('children')
            ->get();
    }
}
