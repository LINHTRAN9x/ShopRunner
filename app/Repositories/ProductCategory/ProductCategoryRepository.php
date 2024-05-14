<?php

namespace App\Repositories\ProductCategory;

use App\Models\ProductCategory;
use App\Repositories\BaseRepository;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryRepositoryInterface
{

    public function getModel()
    {
        return ProductCategory::class;
    }
}
