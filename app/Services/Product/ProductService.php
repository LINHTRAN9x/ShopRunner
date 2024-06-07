<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\BaseService;

class ProductService extends BaseService implements ProductServiceInterface
{
    public $repository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function getProductFeatured(){
        return [
            $this->repository->getProductFeatured(0),
            $this->repository->getProductFeatured(1),
            $this->repository->getProductFeatured(2)
        ];
    }
    public function find(int $id)
    {
       $product = $this->repository->find($id);

       $avgRating = 0;
       $sumRating = array_sum(array_column($product->productComments->toArray(),'rating'));
       $countRating = count($product->productComments);
       if($countRating != 0){
           $avgRating = $sumRating/$countRating;
       }
       $product->avgRating = $avgRating;
       return $product;
    }

    public function getRelatedProducts($product, $limit =4){
        return $this->repository->getRelatedProducts($product,$limit);
    }
    public function getProductOnIndex($request){
        // Lấy tham số lọc giá từ yêu cầu
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');
        return $this->repository->getProductOnIndex($request,$priceMin, $priceMax);
    }

    public function getProductsByCategory($categoryName, $request){
        // Lấy tham số lọc giá từ yêu cầu
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');
        return $this->repository->getProductsByCategory($categoryName, $request,$priceMin, $priceMax);
    }

    public function findBySize($productId, $size)
    {

        return $this->repository->findBySize($productId,$size);
    }


}
