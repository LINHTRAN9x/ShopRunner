<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUploadHelper;
use App\Helpers\OptionsHelper;
use App\Models\ProductCategory;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    public function index()
    {
        $locale = Session()->get('locale');
        $brands = Brand::paginate(5);
        $categories = ProductCategory::all();
        return view('admin.brand.index', ['brands' => $brands, 'categories' => $categories,'locale' => $locale]);
    }

    public function create()
    {
        $categories = Category::all();
        $rootCategories = Category::where('parent_id', 0)->get();
        // Generate options for the dropdown
        $options = OptionsHelper::generateOptions($rootCategories);
        return view('admin.brand.add', ['options' => $options]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust maximum file size as needed
            'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust maximum file size as needed
            'categories_id' => 'required|array', // Ensure that categories are submitted as an array
            'categories_id.*' => 'exists:categories,id', // Ensure that each category ID exists in the categories table
        ]);

        DB::beginTransaction();

        try {
            $bandName = $validatedData['name'];
            $logo = $request->file('logo');
            $logoInfoArr = ImageUploadHelper::uploadImage($logo, "brands/$bandName");

            $banner = $request->file('banner');
            $bannerInfoArr = ImageUploadHelper::uploadImage($banner, "brands/$bandName");


            $brand = Brand::create([
                'name' => $validatedData['name'],
                'logo_name' => $logoInfoArr['imageName'],
                'logo_path' => $logoInfoArr['imagePath'],
                'logo_origin_name' => $logoInfoArr['originName'],
                'banner_name' => $bannerInfoArr['imageName'],
                'banner_path' => $bannerInfoArr['imagePath'],
                'banner_origin_name' => $bannerInfoArr['originName'],
            ]);
            // Attach the selected categories to the brand
            $brand->categories()->attach($validatedData['categories_id']);

            // Redirect back with success message
            DB::commit();
//            dd("success");
            return redirect()->route('brands')->with('success', 'Brand created successfully.');
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

    public function edit($id)
    {
        $rootCategories = Category::where('parent_id', 0)->get();

        $brand = Brand::findOrFail($id);
        $selectedCategories = $brand->categories()->get();

        $options = OptionsHelper::generateOptionsWithSelected($rootCategories, $selectedCategories);
        return view('admin.brand.edit', ['brand' => $brand, 'options' => $options]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust maximum file size as needed
            'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust maximum file size as needed
            'categories_id' => 'required|array', // Ensure that categories are submitted as an array
            'categories_id.*' => 'exists:categories,id', // Ensure that each category ID exists in the categories table
        ]);
        DB::beginTransaction();
        try {
            // Find the brand by its ID
            $brand = Brand::findOrFail($id);

            $bandName = $validatedData['name'];
            $logo = $request->file('logo');
            $logoInfoArr = ImageUploadHelper::uploadImage($logo, "brands/$bandName");

            $banner = $request->file('banner');
            $bannerInfoArr = ImageUploadHelper::uploadImage($banner, "brands/$bandName");

            $brand->update([
                'name' => $validatedData['name'],
                'logo_name' => $logoInfoArr['imageName'],
                'logo_path' => $logoInfoArr['imagePath'],
                'logo_origin_name' => $logoInfoArr['originName'],
                'banner_name' => $bannerInfoArr['imageName'],
                'banner_path' => $bannerInfoArr['imagePath'],
                'banner_origin_name' => $bannerInfoArr['originName'],
            ]);
            // Save the brand changes
            $brand->save();
            // Sync the categories associated with the brand
            $brand->categories()->sync($validatedData['categories_id']);

            // Commit the transaction
            DB::commit();

            // Redirect back with success message
            return redirect()->route('brands.edit', $id)->with('success', 'Brand updated successfully.');
        } catch (\Exception $exception) {
            // If an exception occurs, rollback the transaction
            DB::rollback();
            $detailedError = 'Message: '.$exception->getMessage() . ' --- File: ' . $exception->getFile() . ' --- Line: ' . $exception->getLine();
            Log::error($detailedError);

            // Flash the detailed error message to the session
            return back()->with('error', $detailedError);
        }
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect(route('brands'));
    }

    public function restore(Request $request)
    {

        $id = $request->input('id');
        // Fetch categories based on showDeleted value
        $softDeleted = Brand::withTrashed()->find($id);
//        dd($softDeleted);
        // Check if the category exists
        if ($softDeleted) {

            $softDeleted->restore();

            // Category found, you can perform further actions here
            return response()->json(['brand' => $softDeleted]);
        } else {
            // Category not found
            return response()->json(['message' => 'Brand not found.'], 404);
        }
    }

}
