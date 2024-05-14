<?php

namespace App\Repositories\ProductSize;

use App\Models\ProductSize;
use App\Repositories\BaseRepository;

class ProductSizeRepository extends BaseRepository implements ProductSizeRepositoryInterface
{

    public function getModel()
    {
        return ProductSize::class;
    }
}
