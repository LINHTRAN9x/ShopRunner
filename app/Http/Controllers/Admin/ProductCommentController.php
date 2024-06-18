<?php

namespace App\Http\Controllers\Admin;
use App\Models\ProductComment;
use Illuminate\Http\Request;
class ProductCommentController extends Controller
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
            $query = ProductComment::query();
            if ($showDeleted === 'yes') {
                $query = $query->withTrashed();
            }
            if ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('id', 'like', "%$searchTerm%")
                        ->orWhere('name', 'like', "%$searchTerm%")
                        ->orWhere('messages', 'like', "%$searchTerm%")
                        ->orWhere('rating', 'like', "%$searchTerm%")
                        ->orWhere('status', 'like', "%$searchTerm%")
                        ->orWhere('shop_response', 'like', "%$searchTerm%")
                        ->orWhere('updated_at', 'like', "%$searchTerm%")
                        ->orWhere('created_at', 'like', "%$searchTerm%");
                });
            }
            if ($sortBy === 'product_id') {
                $query->join('products', 'products.id', '=', 'product_comments.product_id')
                    ->orderBy('products.name', $sortDirection)
                    ->select('product_comments.*');
            } else {
                $query->orderBy($sortBy, $sortDirection);
            }


            $productComments = $query->paginate(10);

            return view('admin.productComment.index', compact('productComments', 'sortBy', 'sortDirection', 'searchTerm', 'showDeleted'));
        } catch (\Exception $exception) {
            return back()->with('error', 'Something went wrong, please try again!');
        }
    }

    public function getShopResponse(Request $request, ProductComment $productComment) {
        if ($productComment) {
            $shopResponse = $productComment->shop_response ?? '';
            return response()->json(['success' => true, 'message' => 'getShopResponse successfully.', 'shopResponse' => $shopResponse]);
        }
        return response()->json(['success' => false, 'message' => '$review not found,Cant getShopResponse.']);
    }

    public function submitShopResponse(Request $request, ProductComment $productComment) {
        try {

            $newShopResponse = $request->newShopResponse;
            if ($productComment) {
                $productComment->shop_response = $newShopResponse??'';

                // Save the changes
                $productComment->save();
                $reviewResponseWarningView = view('admin.partials.reviewResponseWarningView', ['productComment'=> $productComment])->render();

                return response()->json(['success' => true, 'message' => 'submitShopResponse successfully.', 'reviewResponseWarningView' => $reviewResponseWarningView]);
            }
            return response()->json(['success' => false, 'message' => '$review not found, cant submitShopResponse.']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong, cant submitShopResponse.', 404]);
        }
    }

    public function updateProductCommentStatus(Request $request, ProductComment $productComment) {
        try {
            $newStatus = $request->newStatus;
            if ($productComment) {
                $productComment->status = $newStatus; // Replace 'Paid' with the actual status
                // Save the changes
                $productComment->save();
                return response()->json(['success' => true, 'message' => 'updateReviewStatus Changed successfully.']);
            }
            return response()->json(['success' => false, 'message' => '$review not found,updateReviewStatus failure.']);
        }catch(\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong,updateReviewStatus failure.', 404]);
        }
    }

    public function delete($id)
    {
        $productComment = productComment::withTrashed()->find($id);
        if ($productComment) {
            $productComment->delete();
//            session()->flash('success', 'productComment deleted successfully');
            $html = view('admin.partials._productComment_buttons', ['productComment' => $productComment])->render();
            return response()->json(['success' => true, 'message' => 'productComment deleted successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'productComment not found.');
            return response()->json(['success' => false, 'message' => 'productComment not found.']);
        }
    }


    public function restore($id)
    {
        $productComment = productComment::withTrashed()->find($id);
        if ($productComment) {
            $productComment->restore();
//            session()->flash('success', 'productComment restored successfully');
            $html = view('admin.partials._productComment_buttons', ['productComment' => $productComment])->render();
            return response()->json(['success' => true, 'message' => 'productComment restored successfully', 'html' => $html]);
        } else {
            session()->flash('error', 'productComment not found.');
            return response()->json(['success' => false, 'message' => 'productComment not found.']);
        }
    }
}
