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
    public function delete($id)
    {
        $category = ProductCategory::withTrashed()->find($id);
        if ($category) {
            $category->delete();
//            session()->flash('success', 'Brand deleted successfully');
            $html = view('admin.partials._category_buttons', ['category' => $category])->render();
            return response()->json(['success' => true, 'message' => 'Brand deleted successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'Brand not found.');
            return response()->json(['success' => false, 'message' => 'Brand not found.']);
        }
    }


    public function restore($id)
    {
        $category= ProductCategory::withTrashed()->find($id);
        if ($category) {
            $category->restore();
//            session()->flash('success', 'category restored successfully');
            $html = view('admin.partials._category_buttons', ['category' => $category])->render();
            return response()->json(['success' => true, 'message' => 'Brand restored successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'Brand not found.');
            return response()->json(['success' => false, 'message' => 'Brand not found.']);
        }
    }
    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // Begin database transaction
        DB::beginTransaction();

        try {
            if ($category)
            {
                $category->name = $request->name;
                $category->save();

                session()->flash('success', 'category updated successfully');
                DB::commit();
                return response()->json(['success' => true, 'message' => 'category updated successfully']);
            }else {
                session()->flash('error', 'Failed to create product!');
                return response()->json(['success' => false, 'message' => 'category updated unsuccessfully.']);
            }

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Failed to update category', 'error' => $e->getMessage()], 500);
        }
    }
    public function edit(Request $request ,ProductCategory $category)
    {
        try {
            if($category)
                return response()->json(['success'=> true,'category' => $category]);
            else
                return response()->json(['success'=> false,'message' => 'failed to Get category data ']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request){

        try {
            $category = ProductCategory::create([
                'name' => $request->input('name'),
            ]);

            if ($category) {
                session()->flash('success', 'category created successfully');
                return response()->json(['success' => true, 'message' => 'category created successfully']);
            } else {
                session()->flash('error', 'Failed to create category');
                return response()->json(['success' => false, 'message' => 'category  created unsuccessfully.']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create category, Something went wrong!');
            return response()->json(['success' => false, 'message' => 'Failed to create category', 'error' => $e->getMessage()], 500);
        }
    }
    public function index( Request $request) {
        try {
            $sortBy = $request->get('sort_by', 'created_at'); // Default column to sort by
            $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction
            $showDeleted = $request->get('show_deleted', 'no'); // Default to not showing deleted
            $searchTerm = $request->get('search_term', '');

            if (!in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'desc';
            }
            $query = ProductCategory::query();
            if ($showDeleted === 'yes') {
                $query = $query->withTrashed();
            }
            if ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('id', 'like', "%$searchTerm%")
                        ->orWhere('name', 'like', "%$searchTerm%")
                        ->orWhere('updated_at', 'like', "%$searchTerm%")
                        ->orWhere('created_at', 'like', "%$searchTerm%");
                });
            }

            if ($sortBy) {
                $query->orderBy($sortBy, $sortDirection);
            }

            $categories = $query->paginate(10);

            return view('admin.category.index', compact('categories', 'sortBy', 'sortDirection', 'searchTerm', 'showDeleted'));
        } catch (\Exception $exception) {
            return back()->with('error', 'Something went wrong, please try again!');
        }
    }
}
