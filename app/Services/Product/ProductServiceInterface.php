<?php

namespace App\Services\Product;

use App\Services\ServiceInterface;

interface ProductServiceInterface extends ServiceInterface
{
    public function getRelatedProducts($product, $limit =4);
    public function getProductOnIndex($request);
    public function getProductsByCategory($categoryName, $request);

    public function getProductFeatured();
    public function findBySize($productId, $size);

}
