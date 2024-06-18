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
    public function index(Request $request)
    {
        try {
            $sortBy = $request->get('sort_by', 'created_at'); // Default column to sort by
            $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction
            $showDeleted = $request->get('show_deleted', 'no'); // Default to not showing deleted
            $searchTerm = $request->get('search_term', '');

            if (!in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'desc';
            }
            $query = Brand::query();
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

            $brands = $query->paginate(10);

            return view('admin.brand.index', compact('brands', 'sortBy', 'sortDirection', 'searchTerm', 'showDeleted'));
        } catch (\Exception $exception) {
            return back()->with('error', 'Something went wrong, please try again!');
        }
    }

    public function store(Request $request)
    {
        try {
            $brand = Brand::create([
                'name' => $request->input('name'),
            ]);

            if ($brand) {
                session()->flash('success', 'Brand created successfully');
                return response()->json(['success' => true, 'message' => 'Brand created successfully']);
            } else {
                session()->flash('error', 'Failed to create Brand');
                return response()->json(['success' => false, 'message' => 'Brand  created unsuccessfully.']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create Brand');
            return response()->json(['success' => false, 'message' => 'Failed to create Brand', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit(Request $request ,Brand $brand)
    {
        try {
            if($brand)
                return response()->json(['success'=> true,'brand' => $brand]);
            else
                return response()->json(['success'=> false,'message' => 'failed to Get brand data ']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // Begin database transaction
        DB::beginTransaction();

        try {
            if ($brand)
            {
                $brand->name = $request->name;
                $brand->save();

                session()->flash('success', 'Brand updated successfully');
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Brand updated successfully']);
            }else {
                session()->flash('error', 'Failed to create product!');
                return response()->json(['success' => false, 'message' => 'Brand updated unsuccessfully.']);
            }

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Failed to update Brand', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $brand = Brand::withTrashed()->find($id);
        if ($brand) {
            $brand->delete();
//            session()->flash('success', 'Brand deleted successfully');
            $html = view('admin.partials._brand_buttons', ['brand' => $brand])->render();
            return response()->json(['success' => true, 'message' => 'Brand deleted successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'Brand not found.');
            return response()->json(['success' => false, 'message' => 'Brand not found.']);
        }
    }


    public function restore($id)
    {
        $brand = Brand::withTrashed()->find($id);
        if ($brand) {
            $brand->restore();
//            session()->flash('success', 'Brand restored successfully');
            $html = view('admin.partials._brand_buttons', ['brand' => $brand])->render();
            return response()->json(['success' => true, 'message' => 'Brand restored successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'Brand not found.');
            return response()->json(['success' => false, 'message' => 'Brand not found.']);
        }
    }


}
