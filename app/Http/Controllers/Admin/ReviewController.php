<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request) {
        $sortBy = $request->get('sort_by', 'created_at'); // Default column to sort by
        $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction
        $showDeleted = $request->get('show_deleted', 'no'); // Default to not showing deleted
        $searchTerm = $request->get('search_term', '');

//        dd($searchTerm);
        // Validate sort direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }
        $query = Review::query();
        // Fetch orders with or without trashed ones
        // Apply search filter if search term is provided
        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('id', 'like', "%$searchTerm%")
                    ->orWhere('user_id', 'like', "%$searchTerm%")
                    ->orWhere('name', 'like', "%$searchTerm%")
                    ->orWhere('product_id', 'like', "%$searchTerm%")
                    ->orWhere('review_text', 'like', "%$searchTerm%")
                    ->orWhere('rating', 'like', "%$searchTerm%")
                    ->orWhere('status', 'like', "%$searchTerm%")
                    ->orWhere('shop_response', 'like', "%$searchTerm%")
                    ->orWhere('created_at', 'like', "%$searchTerm%");
            })
                ->orWhereHas('product', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%$searchTerm%");
                })
//                ->orWhereHas('brand', function ($query) use ($searchTerm) {
//                    $query->where('name', 'like', "%$searchTerm%");
//                })
                ->orWhereHas('user', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%$searchTerm%");
                });
        }
        // Apply sorting
        $query->orderBy($sortBy, $sortDirection);

//        $query = Review::orderBy($sortBy, $sortDirection);

        if ($showDeleted === 'yes') {
            $query = $query->withTrashed();
        }

        $reviews = $query->paginate(5);

        return view('admin.review.index', compact('reviews', 'sortBy', 'sortDirection', 'showDeleted', 'searchTerm'));
    }

    public function updateReviewStatus(Request $request) {
        try {
            $newStatus = $request->newStatus;
            $reviewId = $request->reviewId;
            $review = Review::findOrfail($reviewId);
            if ($review) {
                $review->status = $newStatus; // Replace 'Paid' with the actual status
                // Save the changes
                $review->save();
                return response()->json(['success' => true, 'message' => 'updateReviewStatus Changed successfully.']);
            }
            return response()->json(['success' => false, 'message' => '$review not found,updateReviewStatus failure.']);
        }catch(\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong,updateReviewStatus failure.', 404]);
        }
    }

    public function getSubmitReviewResponse(Request $request) {
        $reviewId = $request->reviewId;

        $review = Review::findOrfail($reviewId);
        if ($review) {
            $shopResponse = $review->shop_response ?? '';
            return response()->json(['success' => true, 'message' => 'getSubmitReviewResponse successfully.', 'shopResponse' => $shopResponse]);
        }
        return response()->json(['success' => false, 'message' => '$review not found,Cant getSubmitReviewResponse.']);
    }

    public function submitReviewResponse(Request $request) {
        try {
            $reviewId = $request->reviewId;
            $newShopResponse = $request->newShopResponse;
            $review = Review::findOrfail($reviewId);
            if ($review) {
                $review->shop_response = $newShopResponse??'';

                // Save the changes
                $review->save();
                $reviewResponseWarningView = view('admin.partials.reviewResponseWarningView', ['review'=> $review])->render();

                return response()->json(['success' => true, 'message' => 'submitReviewResponse successfully.', 'reviewResponseWarningView' => $reviewResponseWarningView]);
            }
            return response()->json(['success' => false, 'message' => '$review not found, cant submitReviewResponse.']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong, cant submitReviewResponse.', 404]);
        }
    }
    public function delete(Request $request, $reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->delete();
        return redirect(route('reviews'));
    }

    public function restore(Request $request)
    {
        $review_id = $request->review_id;
        // Fetch categories based on showDeleted value
        $softDeletedReview = Review::withTrashed()->find($review_id);
        if ($softDeletedReview) {

            $softDeletedReview->restore();

            // Category found, you can perform further actions here
            return response()->json(['success' => true ,'message' => 'Restore thành công.', 'softDeletedReview' => $softDeletedReview]);
        } else {
            // Category not found
            return response()->json(['success'=> false, 'message' => 'softDeletedReview not found.']);
        }
    }

}
