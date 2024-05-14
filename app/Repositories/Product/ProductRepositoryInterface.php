<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getRelatedProducts($product, $limit =4);
    public function getProductFeatured(int $featuredId);
    public function getProductOnIndex($request);
    public function getProductsByCategory($categoryName, $request);

    public function findBySize($productId, $size);

}
