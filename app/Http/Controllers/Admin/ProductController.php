<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUploadHelper;
use App\Helpers\SkuHelper;
use App\Helpers\SummerNoteExtract;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\Tag;
use App\Rules\DifferentQty;
use App\Rules\UniqueProductDetail;
use Illuminate\Http\Request;
use App\Helpers\OptionsHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {

            $sortBy = $request->get('sort_by', 'created_at'); // Default column to sort by
            $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction
            $showDeleted = $request->get('show_deleted', 'no'); // Default to not showing deleted
            $searchTerm = $request->get('search_term', '');
            $minPrice = $request->get('min_price', null);
            $maxPrice = $request->get('max_price', null);

            if (!in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'desc';
            }
            $query = Product::query();
            // Fetch orders with or without trashed ones
            if ($showDeleted === 'yes') {
                $query = $query->withTrashed();
            }
            if ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('id', 'like', "%$searchTerm%")
                        ->orWhere('brand_id', 'like', "%$searchTerm%")
                        ->orWhere('product_category_id', 'like', "%$searchTerm%")
                        ->orWhere('name', 'like', "%$searchTerm%")
                        ->orWhere('description', 'like', "%$searchTerm%")
                        ->orWhere('content', 'like', "%$searchTerm%")
                        ->orWhere('price', 'like', "%$searchTerm%")
                        ->orWhere('qty', 'like', "%$searchTerm%")
                        ->orWhere('discount', 'like', "%$searchTerm%")
                        ->orWhere('weight', 'like', "%$searchTerm%")
                        ->orWhere('sku', 'like', "%$searchTerm%")
                        ->orWhere('featured', 'like', "%$searchTerm%")
                        ->orWhere('tag', 'like', "%$searchTerm%")
                        ->orWhere('notes', 'like', "%$searchTerm%")
                        ->orWhere('additional_info', 'like', "%$searchTerm%")
                        ->orWhere('deleted_at', 'like', "%$searchTerm%");
                })
                    ->orWhereHas('brand', function ($query) use ($searchTerm) {
                        $query->where(function ($query) use ($searchTerm) {
                            $query->where('name', 'like', "%$searchTerm%");
//                            ->orWhere('qty', 'like', "%$searchTerm%"); // Added column
                        });
                    })
                    ->orWhereHas('productCategory', function ($query) use ($searchTerm) {
                        $query->where(function ($query) use ($searchTerm) {
                            $query->where('name', 'like', "%$searchTerm%");
//                        ->orWhere('phone_number', 'like', "%$searchTerm%"); // Added column
                        });
                    });
            }
            if ($sortBy === 'brand_id') {
                $query->join('brands', 'products.brand_id', '=', 'brands.id')
                    ->orderBy('brands.name', $sortDirection)
                    ->select('products.*');
            } elseif ($sortBy === 'product_category_id') {
                $query->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                    ->orderBy('product_categories.name', $sortDirection)
                    ->select('products.*');
            } else {
                $query->orderBy($sortBy, $sortDirection);
            }
            if ($minPrice !== null) {
                $query->where(function ($query) use ($minPrice) {
                    $query->where('price', '>=', $minPrice);
                });
            }

            if ($maxPrice !== null) {
                $query->where(function ($query) use ($maxPrice) {
                    $query->where('price', '<=', $maxPrice);
                });
            }

            $products = $query->paginate(5);


            $brands = Brand::all();
            $categories = ProductCategory::all();

            return view('admin.product.index', compact('products', 'sortBy', 'sortDirection', 'showDeleted', 'searchTerm', 'categories', 'brands', 'minPrice', 'maxPrice'));
        }


    public function getText(Request $request)
    {
        try {
            $product = Product::find($request->id);
            $column = $request->column;
            if ($product) {
                $text = $product ? $product->$column : '';


                return response()->json(['success' => true, 'message' => 'getText thành công.', 'text' => $text]);
            }
            return response()->json(['success' => false, 'message' => '$product not found. getText thất bại']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => '$column not found. getText thất bại']);
        }
    }

    public function updateText(Request $request)
    {
        try {

            $product = Product::find($request->id);
            $column = $request->column;

            if ($product) {
                $product->$column = $request->text;
                $product->save();
                $text = $request->text;
                $truncatedText = strlen($text) > 40 ? substr($text, 0, 40) . '...' : $text;
                return response()->json(['success' => true, 'message' => 'updateText thành công.', 'truncatedText' => $truncatedText]);
            }

            return response()->json(['success' => false, 'message' => '$product not found. updateText thất bại']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => '$column not found. updateText thất bại'], 400);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'brand_id' => 'required|integer|exists:brands,id',
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'price' => 'required|numeric',
            'file' => 'required|array',
            'file.*' => 'string'
        ]);

        try {
            $product = Product::create([
                'brand_id' => $request->brand_id,
                'product_category_id' => $request->product_category_id,
                'name' => $request->productName,
                'description' => $request->description,
                'content' => $request->input('content'),// cuz conflict content protectd Request property
                'price' => $request->price,
                'weight' => $request->weight,
                'featured' => $request->featured,
                'tag' => $request->tag,
                'notes' => $request->notes,
                'additional_info' => $request->additional_info,
                'qty' => 0,
            ]);
            $product->sku = SkuHelper::generateSKU($product->id, $product->name, '');
            $product->save();
            if ($product) {
//            file is an array of baseName
                foreach ($request->input('file') as $baseName) {
//                $oldPath = 'temp/' . $baseName;
//                $newPath = "public/products/$product->id" . $baseName;
//                Storage::disk('local')->move($oldPath, $newPath);// move relative to Storage/app disk('local')
                    $oldPath = storage_path('app/temp/' . $baseName);
                    $newPath = public_path('front/img/product/' . $baseName);

                    // Move file from temp folder to public/front/img/product
                    if (file_exists($oldPath)) {
                        rename($oldPath, $newPath);//also move it to newPath
                    }
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $baseName,
                    ]);
                }
//            $this->cleanupTemporaryImages();
                session()->flash('success', 'Product created successfully');
                return response()->json(['success' => true, 'message' => 'Product created successfully']);
            } else {
                session()->flash('error', 'Failed to create product!');
                return response()->json(['success' => false, 'message' => 'Product created unsuccessfully.']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create product!');
            return response()->json(['success' => false, 'message' => 'Failed to create product', 'error' => $e->getMessage()], 500);
        }
    }

    public function uploadImgDZ(Request $request)
    {
        $fileIds = [];
//        dump('get here');
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {

                $imageName = Str::orderedUuid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAS('temp', $imageName);
                $baseNames[] = ['baseName' => $imageName];
//                $baseNames[] = ['baseName' => basename($path)];
            }
        }

        return response()->json($baseNames);
    }

    public function deleteImgDZ(Request $request)
    {
        $baseName = $request->input('baseName');
        $filePath = 'temp/' . $baseName;//filePath in Storage/app aka local disk and the starting point where Storage:: begins the search

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return response()->json(['message' => 'File deleted successfully']);
        }
        return response()->json(['message' => 'File not found'], 404);
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            $images = $product->productImages()->select('id', 'path')->get(); // Assuming 'images' is the relationship

            return response()->json(['thisProduct' => $product, 'images' => $images]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'brand_id' => 'required|integer|exists:brands,id',
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'price' => 'required|numeric',
            'file' => 'array',
            'file.*' => 'string'
        ]);

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Find the product by ID
            $product = Product::findOrFail($id);

            // Update the product record
            $product->brand_id = $request->brand_id;
            $product->product_category_id = $request->product_category_id;
            $product->name = $request->productName;
            $product->description = $request->description;
            $product->content = $request->input('content'); // Handle content properly
            $product->price = $request->price;
            $product->weight = $request->weight;
            $product->featured = $request->featured;
            $product->tag = $request->tag;
            $product->notes = $request->notes;
            $product->additional_info = $request->additional_info;
            $product->save();

            if ($product) {
                $newBaseNames = $request->input('file') ? $request->input('file') : [];
//                dd($newBaseNames);
//            file is an array of baseName
                foreach ($newBaseNames as $baseName) {
//                $oldPath = 'temp/' . $baseName;
//                $newPath = "public/products/$product->id" . $baseName;
//                Storage::disk('local')->move($oldPath, $newPath);// move relative to Storage/app disk('local')
                    $oldPath = storage_path('app/temp/' . $baseName);
                    $newPath = public_path('front/img/product/' . $baseName);

                    // Move file from temp folder to public/front/img/product
                    if (file_exists($oldPath)) {
                        rename($oldPath, $newPath);//also move it to newPath
                    }
                    ProductImage::firstOrCreate(
                        ['product_id' => $product->id, 'path' => $baseName]
                    );
                }
                // Remove images not in $newBaseNames from both storage and database
                $currentBaseNames = ProductImage::where('product_id', $product->id)->pluck('path')->toArray();
                $imagesToRemove = array_diff($currentBaseNames, $newBaseNames);

                foreach ($imagesToRemove as $baseName) {
                    // Delete image from storage
                    $filePath = public_path('front/img/product/' . $baseName);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }

                    // Delete record from ProductImage table
                    ProductImage::where('product_id', $product->id)->where('path', $baseName)->delete();
                }


//            $this->cleanupTemporaryImages();
                session()->flash('success', 'Product updated successfully');
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Product updated successfully']);
            } else {
                session()->flash('error', 'Failed to create product!');
                return response()->json(['success' => false, 'message' => 'Product updated unsuccessfully.']);
            }

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Failed to update product', 'error' => $e->getMessage()], 500);
        }
    }

    public function emptyTempFolder()
    {
        // Delete all files in temporary_images directory
        if (Storage::deleteDirectory('temp')) {
            return response()->json(['success' => true, 'message' => 'emptyTempFolder successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'emptyTempFolder unsuccessfully.']);
        }

    }

    public function delete($id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product) {
            $product->delete();
//            session()->flash('success', 'Product deleted successfully');
            $html = view('admin.partials._product_buttons', ['product' => $product])->render();
            return response()->json(['success' => true, 'message' => 'Product deleted successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'Product not found.');
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product) {
            $product->restore();
//            session()->flash('success', 'Product restored successfully');
            $html = view('admin.partials._product_buttons', ['product' => $product])->render();
            return response()->json(['success' => true, 'message' => 'Product restored successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'Product not found.');
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }
    }

//    productDetail
    public function productDetails(Request $request, Product $product)
    {
        try {
            $productId = $product->id;

            $sortBy = $request->get('sort_by', 'created_at'); // Default column to sort by
            $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction
//        $showDeleted = $request->get('show_deleted', 'no'); // Default to not showing deleted
            $searchTerm = $request->get('search_term', '');

            if (!in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'desc';
            }
            $query = ProductDetail::where('product_id', $productId);

            if ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('id', 'like', "%$searchTerm%")
                        ->orWhere('color', 'like', "%$searchTerm%")
                        ->orWhere('size', 'like', "%$searchTerm%")
                        ->orWhere('qty', 'like', "%$searchTerm%");
                });
            }

            if ($sortBy) {
                $query->orderBy($sortBy, $sortDirection);
            }

            $productDetails = $query->paginate(10);

            return view('admin.product.productDetail', compact('product', 'sortBy', 'sortDirection', 'searchTerm', 'productDetails'));
        } catch (\Exception $exception) {
            session()->flash('error', 'Something went wrong, please try again!');
            return back();
        }
    }
    public function storeItem(Request $request, Product $product){
//        dd($product->name);
        $request->validate([
            'color' => 'required|string|max:255',
            'size' => [
                'required',
                'string',
                'max:255',
                new UniqueProductDetail($product, $request->input('color')),
            ],
            'qty' => 'required|integer|min:0',
        ]);

        try {
            $productDetails = $product->productDetails()->create([
                'color' => $request->input('color'),
                'size' => $request->input('size'),
                'qty' => $request->input('qty'),
            ]);

            if ($productDetails) {
                $product->qty = $product->productDetails()->sum('qty');
                $product->save();
                session()->flash('success', 'Product Item created successfully');
                return response()->json(['success' => true, 'message' => 'Product Item created successfully']);
            } else {
                session()->flash('error', 'Failed to create Product Item');
                return response()->json(['success' => false, 'message' => 'Product item created unsuccessfully.']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create Product Item');
            return response()->json(['success' => false, 'message' => 'Failed to create product item', 'error' => $e->getMessage()], 500);
        }
    }
    public function editItem(ProductDetail $productDetail)
    {
        try {
            if($productDetail)
                return response()->json(['success'=> true,'productDetail' => $productDetail]);
            else
                return response()->json(['success'=> false,'message' => 'failed to Get Item data ']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateItem(Request $request, ProductDetail $productDetail)
    {
        $product = $productDetail->product()->first();

        $request->validate([
            'color' => 'required|string|max:255',
            'size' => [
                'required',
                'string',
                'max:255',
                new UniqueProductDetail($product, $request->input('color'),$productDetail->id),
            ],
            'qty' => [
                'required',
                'integer',
                'min:0',
//                new DifferentQty($productDetail),
            ],
        ]);
        // Begin database transaction
        DB::beginTransaction();

        try {
            if ($productDetail)
            {
                $productDetail->qty = $request->qty;
                $productDetail->color = $request->color;
                $productDetail->size = $request->size;
                $productDetail->save();

                $product->qty = $product->productDetails()->sum('qty');
                $product->save();

                session()->flash('success', 'Product Item updated successfully');
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Product Item updated successfully']);
            }else {
                session()->flash('error', 'Failed to create product!');
                return response()->json(['success' => false, 'message' => 'Product updated unsuccessfully.']);
            }

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Failed to update product item', 'error' => $e->getMessage()], 500);
        }
    }

    public function deleteItem(Request $request, ProductDetail $productDetail)
    {
        if ($productDetail) {
            $productDetail->delete(); // or $productDetail->softDelete() depending on your soft delete implementation
        }

        // Update the total quantity of the product
        $product = $productDetail->product()->first();
        $product->qty = $product->productDetails()->sum('qty');
        $product->save();

        // Get the query parameters from the request and convert them to a query string
        $queryParams = http_build_query($request->query());

        // Flash success message
        session()->flash('success', 'Product Item deleted successfully');

        // Build the redirect URL
        $redirectUrl = route('products.productDetails', ['product' => $product->id]) . '?' . $queryParams;

        // Redirect to the URL with the query string
        return redirect($redirectUrl);
    }

}
