<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function getModel()
    {
        return Product::class;
    }

    public function getProductFeatured(int $featuredId)
    {
        if ($featuredId == 1) {
            $tenDaysAgo = Carbon::now()->subDays(10);

            return $this->model->where('featured', $featuredId)
                ->where('created_at', '>=', $tenDaysAgo)
                ->orderBy('id', 'desc')
                ->get();
        }
        return $this->model->where('featured', $featuredId)
            ->orderBy("id","desc")
            ->get();
    }

    public function getRelatedProducts($product, $limit =4)
    {
        return $this->model->where('product_category_id',$product->product_category_id)
            ->where('tag',$product->tag)
            ->limit($limit)->get();
    }

    public function getProductOnIndex($request)
    {
        //SEARCH
        $search = $request->search ?? '';

        $products = $this->model->where("name",'like','%'.$search.'%');

        // Lấy tham số lọc giá
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');
        // Áp dụng điều kiện lọc giá nếu có
        if ($priceMin !== null) {
            $products->where('price', '>=', $priceMin);
        }
        if ($priceMax !== null) {
            $products->where('price', '<=', $priceMax);
        }

        $products = $this->filter($products,$request);
        $products = $this->sortAndPagination($products,$request);

        return $products;
    }

    public function getProductsByCategory($categoryName, $request)
    {

        $products = ProductCategory::where('name',$categoryName)->first()->products->toQuery();

        // Lấy tham số lọc giá
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');

        // Áp dụng điều kiện lọc giá nếu có
        if ($priceMin !== null) {
            $products->where('price', '>=', $priceMin);
        }
        if ($priceMax !== null) {
            $products->where('price', '<=', $priceMax);
        }

        $products = $this->sortAndPagination($products,$request);
        $products = $this->filter($products,$request);
        return $products;
    }


    private function sortAndPagination($products,Request $request)
    {
        $perPage = $request->show ?? 12;
        $sortBy = $request->sort_by ?? 'latest';

        switch ($sortBy){
            case 'latest':
                $products = $products->orderByDesc("id");
                break;
            case 'oldest':
                $products = $products->orderBy("id");
                break;
            case 'name-ascending':
                $products = $products->orderBy("name");
                break;
            case 'name-descending':
                $products = $products->orderByDesc("name");
                break;
            case 'price-ascending':
                $products = $products->orderBy("price");
                break;
            case 'price-descending':
                $products = $products->orderByDesc("price");
                break;
            default:
                $products = $products->orderBy("id");
        }
        $products = $products->paginate($perPage);
        $products->appends(['sort_by' => $sortBy, 'show' => $perPage]);

        return $products;
    }

    private function filter($products, Request $request)
    {
        //category
        $categories = $request->category ?? [];
        $category_ids = array_keys($categories);
        $products = $category_ids != null ? $products->whereIn('product_category_id', $category_ids) : $products;

        //Brand
        $brands = $request->brand ?? [];
        $brands_ids = array_keys($brands);
        $products = $brands_ids != null ? $products->whereIn('brand_id',$brands_ids) : $products;

        //Color:
        $color = $request->color;
        $products = $color != null ? $products->whereHas('productDetails', function ($query) use ($color){
            return $query->where('color',$color)
                         ->where('qty', '>', 0);
        }) : $products;

        // Lấy tag từ request
        $tag = $request->tag;

        if ($tag) {
            // Lọc sản phẩm theo tag
            $products = $products->where('tag', $tag);
        }


        //Size:
        $size = $request->size;
        $products = $size != null ? $products->whereHas('productDetails', function ($query) use ($size){
            return $query->where('size',$size)
                ->where('qty', '>', 0);
        }) : $products;



        return $products;
    }

    public function findBySize($productId, $size)
    {
        $products = Product::find($productId);

        if ($products) {
            foreach ($products->productDetails as $productDetail) {
                // Kiểm tra xem size của chi tiết sản phẩm có trùng khớp không
                if ($productDetail->size == $size) {
                    // Trả về chi tiết sản phẩm nếu kích thước trùng khớp
                    return $productDetail;
                }
            }
        }

        // Trả về null nếu không tìm thấy hoặc không tồn tại sản phẩm
        return null;
    }


}
