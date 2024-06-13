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
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\Tag;
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
    public function index(Request $request) {
        $sortBy = $request->get('sort_by', 'created_at'); // Default column to sort by
        $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction
        $showDeleted = $request->get('show_deleted', 'no'); // Default to not showing deleted
        $searchTerm = $request->get('search_term', '');


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

        $products = $query->paginate(5);


        $brands = Brand::all();
        $categories = ProductCategory::all();

        return view('admin.product.index', compact('products', 'sortBy', 'sortDirection', 'showDeleted','searchTerm', 'categories', 'brands'));
    }

    public function getText(Request $request) {
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

    public function updateText(Request $request) {
        try {

            $product = Product::find($request->id);
            $column = $request->column;

            if ($product) {
                $product->$column = $request->text;
                $product->save();
                $text = $request->text;
                $truncatedText = strlen($text) > 40 ? substr($text, 0, 40).'...':$text;
                return response()->json(['success' => true ,'message' => 'updateText thành công.','truncatedText' => $truncatedText]);
            }

            return response()->json(['success'=> false, 'message' => '$product not found. updateText thất bại']);
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
            $product->sku = SkuHelper::generateSKU($product->id,$product->name, '');
            $product->save();
            if($product) {
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
                return response()->json(['success'=>true, 'message' => 'Product created successfully']);
            }else {
                session()->flash('error', 'Failed to create product!');
                return response()->json(['success'=>false,'message' => 'Product created unsuccessfully.']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create product!');
            return response()->json(['success'=>false, 'message' => 'Failed to create product', 'error' => $e->getMessage()], 500);
        }
    }

    public function uploadImgDZ(Request $request)
    {
        $fileIds = [];
//        dump('get here');
        if($request->hasFile('file')) {
            foreach($request->file('file') as $file) {

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

    public function orderDetails(Request $request, Product $product) {

//        $user = $order->user;
//        $orderDetails = $order->orderDetails();
////        dd($orderDetails->latest()->get());
//        // Calculate total quantity (sum of qty for all order details)
//        $totalQuantity = $orderDetails->sum('qty');
//
//        // Calculate total amount (sum of amount for all order details)
//        $totalAmount = 0;
//        foreach ($order->orderDetails()->get() as $orderDetail) {
//            $totalAmount+=$orderDetail->amount * $orderDetail->qty;
//        }
//
//        $total = $orderDetails->first()->total;
//
//        // Calculate individual product total amount (sum of amount for each product)
////        $individualTotalAmount = $orderDetails->groupBy('product_id')
////            ->map(function ($item) {
////                return $item->sum('amount');
////            })->sum();
//
//        // Calculate shipping fee
//        $shippingFee = $total - $totalAmount;
//        $orderDetails = $order->orderDetails()->get();
////        dd(gettype($orderDetails) );
//
//        return view('admin.order.orderDetails', [
//            'order' => $order,
//            'orderDetails' => $orderDetails,
//            'user' => $user,
//            'totalAmount' => $totalAmount,
//            'shippingFee' => $shippingFee,
//            'total' => $total,
//            'totalQuantity' =>$totalQuantity
//        ]);
    }

    public function edit($id) {
        try {
            $product = Product::findOrFail($id);
            $images = $product->productImages()->select('id', 'path')->get(); // Assuming 'images' is the relationship

            return response()->json(['thisProduct' => $product, 'images' => $images]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id) {
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

            if($product) {
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
                return response()->json(['success'=>true, 'message' => 'Product updated successfully']);
            }else {
                session()->flash('error', 'Failed to create product!');
                return response()->json(['success'=>false,'message' => 'Product updated unsuccessfully.']);
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
        if(Storage::deleteDirectory('temp')) {
            return response()->json(['success'=>true, 'message' => 'emptyTempFolder successfully']);
        }else {
            return response()->json(['success'=>false,'message' => 'emptyTempFolder unsuccessfully.']);
        }

    }

//    public function create() {
//        $brands = Brand::all();
//        $categories = Category::all();
//        $sizes = Size::all();
//        $tags = Tag::all();
//        return view('admin.product.add',[
//            'brands' => $brands,
//            'categories' => $categories,
//            'sizes' => $sizes,
//            'tags'=>$tags
//        ]);
//    }

//    public function store(Request $request) {
//
//        $validatedData = $request->validate([
//            'name' => 'required|max:255|unique:products,name',
//            'sale_price' => 'numeric|min:0',
//            'price' => 'numeric|min:0',
//            'intro' => 'nullable|string',
//            'material' => 'nullable|string',
//            'color' => 'nullable|string',
//            'sizes' => 'array', // Assuming this is the name of the select element for sizes
//            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//            'product_images.*' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rules for each product image
//            'description' => 'nullable|string', // Assuming this is the name of the textarea element for product description
//            'category_id'=> 'nullable|exists:categories,id',
//            'brand_id'=> 'nullable|exists:brands,id',
//        ]);
//
//
////        dd($validatedData['product_images']);
//        try {
//            DB::beginTransaction();
//            $productName = $validatedData['name'];
//            $featureImage = $request->file('feature_image');
//            $featureImageInfoArr = ImageUploadHelper::uploadImage($featureImage, "products/$productName");
//
//            $content = SummerNoteExtract::extractSummerNote($request);
//
//
//            $product = Product::create([
//                'name' => $validatedData['name'],
//                'sale_price' => $validatedData['sale_price'],
//                'price' => $validatedData['price'],
//                'feature_image_path' => $featureImageInfoArr['imagePath'],
//                'feature_image_name' => $featureImageInfoArr['imageName'],
//                'feature_image_origin_name' => $featureImageInfoArr['originName'],
//                'content' => $content,
//                'intro' => $validatedData['intro'],
//                'material' => $validatedData['material'],
//                'color' => $validatedData['color'],
//                'user_id' => Auth::id(),
//                'category_id' => $validatedData['category_id'],
//                'brand_id' => $validatedData['brand_id'],
//            ]);
//
//
////            $product->productImages()
//            foreach ($validatedData['product_images'] as $productImage) {
//                $featureImageInfoArr = ImageUploadHelper::uploadImage($productImage, "products/$productName");
//                $product->productImages()->create([
//                    'image_path' => $featureImageInfoArr['imagePath'],
//                    'image_name' => $featureImageInfoArr['imageName'],
//                    'image_origin_name' => $featureImageInfoArr['originName']
//                ]);
//            }
//
//            $sku = SkuHelper::generateSKU($product->id, $product->name, '');// sku for the product not relying on sizes
//
////            $product->tags()
//            $product->tags()->detach();
//// Iterate over the updated list of tag names
//            foreach ($request->input('tags', []) as $tagName) {
//                // Get the tag by name or create a new one if it doesn't exist
//                $tagName = trim($tagName);
//                $tag = Tag::firstOrCreate(['name' => $tagName]);
//
//                // Attach the tag to the product if it's not already attached
//                if (!$product->tags()->where('tag_id', $tag->id)->exists()) {
//                    $product->tags()->attach($tag->id);
//                }
//            }
////           1 tag is the sku
//            $tag = Tag::firstOrCreate(['name' => $sku]);
//            // Attach the tag to the product if it's not already attached
//            if (!$product->tags()->where('tag_id', $tag->id)->exists()) {
//                $product->tags()->attach($tag->id);
//            }
////           $product->sizes() quantity
//            $totalQuantity = 0;
//            foreach ($request->input('sizes', []) as $sizeId) {
//                $quantityFieldName = 'qtyInput' . $sizeId;
//                $quantity = $request->input($quantityFieldName, 0);
//                $totalQuantity += $quantity;
//                // Attach the product size to the product
//                $product->sizes()->attach($sizeId, ['quantity' => $quantity]);
//            }
////            create remaining columns data
//            $product->update([
//                'total_quantity' => $totalQuantity, // Update the total_quantity column to 100\
//                'sku' => $sku,
//                // You can add more columns to update here if needed
//            ]);
//            DB::commit();
////            dd("success");
//            return redirect()->route('products')->with('success', 'Product created successfully.');
//        } catch (\Exception $exception) {
//            // If an exception occurs, rollback the transaction
//            DB::rollback();
//            $detailedError = 'Message: '.$exception->getMessage() . ' --- File: ' . $exception->getFile() . ' --- Line: ' . $exception->getLine();
//            Log::error($detailedError);
//
//            // Flash the detailed error message to the session
//            return back()->with('error', $detailedError);
//        }
//    }


//    public function fetchQuantity(Request $request) {
//        $sizeId = $request->input('sizeId');
//        $productId = $request->input('productId');
//
////        dd($sizeId.'abc'.$productId);
//        // If you passed data directly without a key, retrieve it like this:
//        // $size = $request->size;
//        $productSize = ProductSize::where('product_id', $productId)
//            ->where('size_id', $sizeId)
//            ->first();
//
//        // Query to fetch the quantity for the given size
//        $quantity = $productSize ? $productSize->quantity : null;
//        // If quantity is not found, default to 0
//        $quantity = $quantity ?? 0;
//        // Return the quantity as JSON response
//
//        return response()->json(['quantity' => $quantity]);
//    }


    public function delete(Request $request,$id) {
//        $product = Product::findOrFail($id);
//        $product->delete();
//        return redirect(route('products'));

        $product = Product::find($id);
        if ($product) {
            $product->delete(); // or $product->softDelete() depending on your soft delete implementation
        }

        // Get the query parameters from the request
        $queryParams = $request->query();
        session()->flash('success', 'Product deleted successfully');
        // Redirect to the orders route with the same query parameters
        return Redirect::route('products', $queryParams);
    }
    public function restore(Request $request)
    {
        //get data passed from Ajax
        $id = $request->input('product_id');
        // Fetch categories based on showDeleted value
        $softDeletedProduct = Product::withTrashed()->find($id);
//        dd($softDeleted);
        // Check if the category exists
        if ($softDeletedProduct) {

            $softDeletedProduct->restore();

            // Category found, you can perform further actions here
            return response()->json(['success' => true ,'message' => 'Restore thành công.']);
        } else {
            // Category not found
            return response()->json(['success'=> false, 'message' => 'restore thất bại.']);

        }
    }

//    public function search(Request $request)
//    {
//        // Get the search term from the request
//        $searchTerm = $request->input('search');
//
//        // Query the posts table for records where the title or description matches the search term
//        $products = Product::where(function ($query) use ($searchTerm) {
//            $query->where('id', 'like', "%$searchTerm%")
//                ->orWhere('name', 'like', "%$searchTerm%")
//                ->orWhere('sale_price', 'like', "%$searchTerm%")
//                ->orWhere('price', 'like', "%$searchTerm%");
//        })
//            // Use orWhereHas to search in related models
//            ->orWhereHas('category', function ($query) use ($searchTerm) {
//                $query->where('name', 'like', "%$searchTerm%");
//            })
//            ->orWhereHas('brand', function ($query) use ($searchTerm) {
//                $query->where('name', 'like', "%$searchTerm%");
//            })
//            ->orWhereHas('user', function ($query) use ($searchTerm) {
//                $query->where('name', 'like', "%$searchTerm%");
//            })
//            ->latest()->paginate(5);;
//
//        // Return the results to your view along with the search term
//        return view('admin.product.index',compact('products', 'searchTerm'));
//    }

}
