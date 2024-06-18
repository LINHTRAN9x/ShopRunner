<?php

namespace App\Http\Controllers\Admin;
use App\Models\Coupon;
use App\Rules\UniqueCouponCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CouponController
{
    public function index(Request $request)
    {

            $sortBy = $request->get('sort_by', 'created_at'); // Default column to sort by
            $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction
            $showDeleted = $request->get('show_deleted', 'no'); // Default to not showing deleted
            $searchTerm = $request->get('search_term', '');

            if (!in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'desc';
            }
            $query = Coupon::query();
            if ($showDeleted === 'yes') {
                $query = $query->withTrashed();
            }
            if ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('coupon_id', 'like', "%$searchTerm%")
                        ->orWhere('coupon_name', 'like', "%$searchTerm%")
                        ->orWhere('coupon_condition', 'like', "%$searchTerm%")
                        ->orWhere('coupon_number', 'like', "%$searchTerm%")
                        ->orWhere('coupon_code', 'like', "%$searchTerm%")
                        ->orWhere('updated_at', 'like', "%$searchTerm%")
                        ->orWhere('created_at', 'like', "%$searchTerm%");
                });
            }

            if ($sortBy) {
                $query->orderBy($sortBy, $sortDirection);
            }

            $coupons = $query->paginate(10);

            return view('admin.coupon.index', compact('coupons', 'sortBy', 'sortDirection', 'searchTerm', 'showDeleted'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'required|integer|min:0',
            'type' => 'required|string',
            'amount' => 'required|integer|min:0',
            'code' => 'required|string|unique:coupons,coupon_code|max:255',
        ]);
        try {
            $coupon = Coupon::create([
                'coupon_name' => $request->input('name'),
                'coupon_time' => $request->input('time'),
                'coupon_condition' => $request->input('type'),
                'coupon_number' => $request->input('amount'),
                'coupon_code' => $request->input('code'),
            ]);

            if ($coupon) {
                session()->flash('success', 'Voucher created successfully');
                return response()->json(['success' => true, 'message' => 'Voucher created successfully']);
            } else {
                session()->flash('error', 'Failed to create Voucher');
                return response()->json(['success' => false, 'message' => 'Voucher  created unsuccessfully.']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create Voucher');
            return response()->json(['success' => false, 'message' => 'Failed to create Voucher', 'error' => $e->getMessage()], 500);
        }
    }
    public function edit(Request $request ,Coupon $coupon)
    {
        try {
            if($coupon)
                return response()->json(['success'=> true,'coupon' => $coupon]);
            else
                return response()->json(['success'=> false,'message' => 'failed to Get coupon data ']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'required|integer|min:0',
            'type' => 'required|string',
            'amount' => 'required|integer|min:0',
//            'code' => 'required|string|unique:coupons,coupon_code|max:255',
            'code' => [
                'required',
                'string',
                'max:255',
                new UniqueCouponCode($coupon),
            ]
        ]);
        // Begin database transaction
        DB::beginTransaction();

        try {
            if ($coupon)
            {
                $coupon->coupon_name = $request->name;
                $coupon->coupon_time = $request->time;
                $coupon->coupon_condition = $request->type;
                $coupon->coupon_number = $request->amount;
                $coupon->coupon_code = $request->code;
                $coupon->save();

                session()->flash('success', 'Voucher updated successfully');
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Voucher updated successfully']);
            }else {
                session()->flash('error', 'Failed to create Voucher!');
                return response()->json(['success' => false, 'message' => 'Voucher updated unsuccessfully.']);
            }

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Failed to update Voucher, something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
    public function delete($id)
    {
        $coupon = Coupon::withTrashed()->find($id);
        if ($coupon) {
            $coupon->delete();
//            session()->flash('success', 'Coupon deleted successfully');
            $html = view('admin.partials._coupon_buttons', ['coupon' => $coupon])->render();
            return response()->json(['success' => true, 'message' => 'Voucher deleted successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'Coupon not found.');
            return response()->json(['success' => false, 'message' => 'Voucher not found.']);
        }
    }
    public function restore($id)
    {
        $coupon = Coupon::withTrashed()->find($id);
        if ($coupon) {
            $coupon->restore();
//            session()->flash('success', 'Coupon restored successfully');
            $html = view('admin.partials._coupon_buttons', ['coupon' => $coupon])->render();
            return response()->json(['success' => true, 'message' => 'Voucher restored successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'Coupon not found.');
            return response()->json(['success' => false, 'message' => 'Voucher not found.']);
        }
    }

}
