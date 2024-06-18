<?php

namespace App\Http\Controllers\Admin;
use App\Models\Permission;
use App\Rules\UniquePermissionName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PermissionController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Sorting and filtering variables
            $sortBy = $request->get('sort_by', 'group');
            $sortDirection = $request->get('sort_direction', 'desc');
            $showDeleted = $request->get('show_deleted', 'no');
            $searchTerm = $request->get('search_term', '');

            // Validate sort direction
            if (!in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'desc';
            }

            // Start building the query
            $query = Permission::query();

            // Include soft deleted if requested
            if ($showDeleted === 'yes') {
                $query->withTrashed();
            }

            // Apply search filters
            if ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('id', 'like', "%$searchTerm%")
                        ->orWhere('name', 'like', "%$searchTerm%")
                        ->orWhere('description', 'like', "%$searchTerm%")
                        ->orWhere('group', 'like', "%$searchTerm%")
                        ->orWhere('updated_at', 'like', "%$searchTerm%")
                        ->orWhere('created_at', 'like', "%$searchTerm%");
                });
            }

            // Apply sorting
            if ($sortBy) {
                $query->orderBy($sortBy, $sortDirection);
            }

            // Fetch all permissions and group them by the 'group' column
            $permissions = $query->paginate(5);

            // Return view with data
            return view('admin.permission.index', compact('permissions', 'sortBy', 'sortDirection', 'searchTerm', 'showDeleted'));
        } catch (\Exception $exception) {
            return back()->with('error', 'Something went wrong, please try again!');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'group' => 'required',
            'description' => 'string|max:255|',
        ]);
        try {
            $permission = Permission::create([
                'name' => $request->input('name'),
                'group' => $request->input('group'),
                'description' => $request->input('description'),

            ]);

            if ($permission) {
                session()->flash('success', 'Permission created successfully');
                return response()->json(['success' => true, 'message' => 'Permission created successfully']);
            } else {
                session()->flash('error', 'Failed to create Permission');
                return response()->json(['success' => false, 'message' => 'Permission  created unsuccessfully.']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create Permission');
            return response()->json(['success' => false, 'message' => 'Failed to create Permission', 'error' => $e->getMessage()], 500);
        }
    }
    public function edit(Request $request ,Permission $permission)
    {

        try {
            if($permission)
                return response()->json(['success'=> true,'permission' => $permission]);
            else
                return response()->json(['success'=> false,'message' => 'failed to Get brand data ']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                new UniquePermissionName($permission),
            ],
            'group' => 'required',
            'description' => 'string|max:255',
        ]);
        // Begin database transaction
        DB::beginTransaction();

        try {
            if ($permission)
            {
                $permission->name = $request->name;
                $permission->group = $request->group;
                $permission->description = $request->description;
                $permission->save();

                session()->flash('success', 'Permission updated successfully');
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Permission updated successfully']);
            }else {
                session()->flash('error', 'Failed to update Permission!');
                return response()->json(['success' => false, 'message' => 'Permission updated unsuccessfully.']);
            }

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Failed to update Permission', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $permission = Permission::withTrashed()->find($id);
        if ($permission) {
            $permission->delete();
//            session()->flash('success', 'Permission deleted successfully');
            $html = view('admin.partials._permission_buttons', ['permission' => $permission])->render();
            return response()->json(['success' => true, 'message' => 'Voucher deleted successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'Permission not found.');
            return response()->json(['success' => false, 'message' => 'Voucher not found.']);
        }
    }
    public function restore($id)
    {
        $permission = Permission::withTrashed()->find($id);
        if ($permission) {
            $permission->restore();
//            session()->flash('success', 'Permission restored successfully');
            $html = view('admin.partials._permission_buttons', ['permission' => $permission])->render();
            return response()->json(['success' => true, 'message' => 'Voucher restored successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'Permission not found.');
            return response()->json(['success' => false, 'message' => 'Voucher not found.']);
        }
    }
}
