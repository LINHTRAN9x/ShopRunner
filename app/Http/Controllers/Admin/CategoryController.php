<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\ImageUploadHelper;
use App\Helpers\OptionsHelper;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Rules\UniqueParentCategoryName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function restore(Request $request)
    {
        $id = $request->input('id');
        // Fetch categories based on showDeleted value
        $softDeletedCategory = Category::withTrashed()->find($id);

        // Check if the category exists
        if ($softDeletedCategory) {

            $softDeletedCategory->restore();

            // Category found, you can perform further actions here
            return response()->json(['category' => $softDeletedCategory]);
        } else {
            // Category not found
            return response()->json(['message' => 'Category not found.'], 404);
        }
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        if ($category->children()->exists()) {
            return back()->with('error', 'Cannot delete category with children. Please delete all children first.');
        }
        $category->delete();
        return redirect(route('categories'));
    }
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueParentCategoryName,
            ],
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust maximum file size as needed
            'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust maximum file size as needed
            'parent_id' => 'required',
        ]);
        DB::beginTransaction();

        try {
            $categoryName = $validatedData['name'];
            $logo = $request->file('logo');
            $logoInfoArr = ImageUploadHelper::uploadImage($logo, "categories/$categoryName");
            $banner = $request->file('banner');
            $bannerInfoArr = ImageUploadHelper::uploadImage($banner, "categories/$categoryName");

            $category = Category::findOrFail($id);
            $category->update([
                'name' => $validatedData['name'],
                'parent_id' => $validatedData['parent_id'],
                'logo_name' => $logoInfoArr['imageName'],
                'logo_path' => $logoInfoArr['imagePath'],
                'logo_origin_name' => $logoInfoArr['originName'],
                'banner_name' => $bannerInfoArr['imageName'],
                'banner_path' => $bannerInfoArr['imagePath'],
                'banner_origin_name' => $bannerInfoArr['originName'],
            ]);
            $category->save();
            // Redirect back with success message
            DB::commit();
//            dd("success");
            return redirect()->route('categories.edit', $id)->with('success', 'Category updated successfully.');
        } catch (\Exception $exception) {
            // If an exception occurs, rollback the transaction
            DB::rollback();
            // Return an error response or handle the exception
            $detailedError = 'Message: '.$exception->getMessage() . ' --- File: ' . $exception->getFile() . ' --- Line: ' . $exception->getLine();
            Log::error($detailedError);

            // Flash the detailed error message to the session
            return back()->with('error', $detailedError);
        }
    }
    public function edit($id) {
        $category = Category::findOrFail($id);
        $parentCategory = $category->parent;

//        dd($parentCategory);
        $rootCategories = Category::where('parent_id', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        // Generate options for the dropdown
//        dd($category->parent_id);
        $options = OptionsHelper::generateCatOptions($rootCategories, $category, $parentCategory);
        return view('admin.category.edit',['category'=> $category, 'options' => $options ]);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueParentCategoryName,
            ],
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048', // Adjust maximum file size as needed
            'banner' => 'image|mimes:jpeg,png,jpg|max:2048', // Adjust maximum file size as needed
            'parent_id' => 'required',
        ]);
        DB::beginTransaction();

        try {
            $categoryName = $validatedData['name'];
            $logo = $request->file('logo');
            $logoInfoArr = ImageUploadHelper::uploadImage($logo, "categories/$categoryName");
            $banner = $request->file('banner');
            $bannerInfoArr = ImageUploadHelper::uploadImage($banner, "categories/$categoryName");

            $category = Category::create([
                'name' => $validatedData['name'],
                'parent_id' => $validatedData['parent_id'],
                'logo_name' => $logoInfoArr['imageName'],
                'logo_path' => $logoInfoArr['imagePath'],
                'logo_origin_name' => $logoInfoArr['originName'],
                'banner_name' => $bannerInfoArr['imageName'],
                'banner_path' => $bannerInfoArr['imagePath'],
                'banner_origin_name' => $bannerInfoArr['originName'],
            ]);
            // Attach the selected categories to the brand

            // Redirect back with success message
            DB::commit();
//            dd("success");
            return redirect()->route('categories')->with('success', 'Category created successfully.');
        } catch (\Exception $exception) {
            // If an exception occurs, rollback the transaction
            DB::rollback();
            $detailedError = 'Message: '.$exception->getMessage() . ' --- File: ' . $exception->getFile() . ' --- Line: ' . $exception->getLine();
            Log::error($detailedError);

            // Flash the detailed error message to the session
            return back()->with('error', $detailedError);
        }
    }
    public function create(){
//        echo('created create method');
        // Get the root categories
        $rootCategories = ProductCategory::where('parent_id', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        // Generate options for the dropdown
        $options = OptionsHelper::generateOptions($rootCategories);

        return view('admin.category.add',['options' => $options]);
    }
    public function index() {
        $locale = Session()->get('locale');
        $categories = ProductCategory::paginate(5);
        return view('admin.category.index',['categories'=> $categories, 'locale' => $locale]);
    }
}
