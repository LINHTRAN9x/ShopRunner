<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function index() {

        $ordersCount = Order::count();
        $productsCount = Product::count();
        $reviewsCount = ProductComment::count();
        $usersCount = User::count();

        $currentDate = now()->toDateString();
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();
        $startOfYear = now()->startOfYear()->toDateString();
        $endOfYear = now()->endOfYear()->toDateString();

        // Fetch revenue for day, week, month, and year
        $revenueDay = $this->calculateRevenue($currentDate, $currentDate);
        $revenueWeek = $this->calculateRevenue($startOfWeek, $endOfWeek);
        $revenueMonth = $this->calculateRevenue($startOfMonth, $endOfMonth);
        $revenueYear = $this->calculateRevenue($startOfYear, $endOfYear);
        $topProducts = $this->getTopProductsByQuantitySold();
//        dd($topProducts);
//        $top5Products = $this->getTop5ProductsSoldThisWeek();
//        $latestOrders = Order::with('orderDetails') // Assuming you have an 'order_details' relationship in your Order model
//        ->orderByDesc('created_at')
//            ->limit(3)
//            ->get();

        $latestOrders = Order::with('orderDetails') // Assuming you have an 'orderDetails' relationship in your Order model
        ->where('status', '<', 3) // Add the condition to filter orders with status smaller than 4
        ->orderByDesc('created_at')
            ->limit(3)
            ->get();
//        dd($latestOrders);

        return view('admin.adminDashboard',compact('ordersCount',
            'usersCount',
            'reviewsCount',
            'productsCount',
            'revenueYear',
            'revenueMonth',
            'revenueWeek',
            'revenueDay',
        ),[
            'orders' => $latestOrders,
            't_products' => $topProducts
        ]);
    }


    private function calculateRevenue($startDate, $endDate)
    {
        // Calculate revenue for the given date range
        $revenue = Order::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->with('orderDetails') // Ensure OrderDetails are eager loaded
            ->get()
            ->sum(function ($order) {
                // Calculate total revenue for each order
                return $order->orderDetails->sum(function ($detail) {
                    return $detail->qty * $detail->amount;
                });
            });
//        dd($revenue);
        return $revenue;
    }


    public function getOrdersForChart()
    {
        // Fetch orders for the last 7 days
        $startDate = Carbon::now()->subDays(50); // Start date is 7 days ago
        $endDate = Carbon::now(); // End date is today

        // Query to fetch count of orders per day
        $ordersData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Prepare data for the chart
        $labels = $ordersData->pluck('date')->toArray(); // Array of dates
        $dataset = [
            [
                'label' => 'Number of Orders',
                'backgroundColor' => 'rgba(60,141,188,0.9)',
                'borderColor' => 'rgba(60,141,188,0.8)',
                'pointRadius' => false,
                'pointColor' => '#3b8bba',
                'pointStrokeColor' => 'rgba(60,141,188,1)',
                'pointHighlightFill' => '#fff',
                'pointHighlightStroke' => 'rgba(60,141,188,1)',
                'data' => $ordersData->pluck('count')->toArray() // Array of order counts
            ]
        ];

        return response()->json([
            'labels' => $labels,
            'dataset' => $dataset
        ]);
    }

    public function getTodayOrderStatusData()
    {
        // Define all possible order statuses
        $ORDER_STATUS_RECEIVEORDERS = 1;
        $ORDER_STATUS_CONFIRMED = 2;
        $ORDER_STATUS_SHIPPING = 3;
        $ORDER_STATUS_FINISH = 4;
        $ORDER_STATUS_CANCEL = 5;

        $ORDER_STATUS = [
            $ORDER_STATUS_RECEIVEORDERS => 'Orders received',
            $ORDER_STATUS_CONFIRMED => 'Confirmed',
            $ORDER_STATUS_SHIPPING => 'Shipping',
            $ORDER_STATUS_FINISH => 'Finished',
            $ORDER_STATUS_CANCEL => 'Canceled',
        ];

        // Fetch orders data for today grouped by status
        $today = Carbon::today();

        // Initialize counts for all statuses to 0
        $orderCounts = [
            $ORDER_STATUS_RECEIVEORDERS => 0,
            $ORDER_STATUS_CONFIRMED => 0,
            $ORDER_STATUS_SHIPPING => 0,
            $ORDER_STATUS_FINISH => 0,
            $ORDER_STATUS_CANCEL => 0,
        ];

        // Query to get counts of orders for each status
        $ordersData = Order::select('status', DB::raw('COUNT(*) as count'))
            ->whereDate('created_at', $today)
            ->groupBy('status')
            ->get();

        // Populate the counts from the query result
        foreach ($ordersData as $order) {
            $orderCounts[$order->status] = $order->count;
        }

        // Prepare data for the chart
        $labels = [];
        $data = [];
        $backgroundColors = ['#000', '#007bff', '#28a745', '#fd7e14', '#dc3545'];

        // Populate labels and data arrays
        foreach ($ORDER_STATUS as $status => $label) {
            $labels[] = $label;
            $data[] = $orderCounts[$status];
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'backgroundColors' => $backgroundColors
        ]);
    }
    public function getTopProductsByQuantitySold()
    {
        $topProducts = DB::table('product_details')
            ->select('product_id', DB::raw('SUM(qty) as total_quantity_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity_sold')
            ->limit(20)
            ->get();

        // Convert to collection
        return $topProductsCollection = collect($topProducts);
    }
//    public function getTop5ProductsSoldThisWeek()
//    {
//        // Get the start and end date of the current week
//        $startOfWeek = Carbon::now()->startOfWeek();  // Monday of the current week
//        $endOfWeek = Carbon::now()->endOfWeek();      // Sunday of the current week
//
//        $topProducts = DB::table('product_details')
//            ->select('product_id', DB::raw('SUM(qty) as total_quantity_sold'))
//            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
//            ->groupBy('product_id')
//            ->orderByDesc('total_quantity_sold')
//            ->limit(5)
//            ->get();
//
//        return $topProducts;
//    }

//    reference


    public function getLatestOrders(Request $request)
    {
        $perPage = 7; // Number of orders per page
        $page = $request->query('page', 1); // Default to page 1 if not provided
        $totalLimit = 15; // Limit total number of orders

        // Fetch the 15 newest orders with status < 3, ordered by created_at descending
        // Fetch the 15 newest orders with status < 3, ordered by created_at descending
        $latestOrders = Order::where('status', '<', 3)
            ->orderByDesc('created_at')
            ->take($totalLimit) // Limit to 15 orders
            ->get();

        // Manually create a paginator for the fetched orders
        $orders = new LengthAwarePaginator(
            $latestOrders->slice(($page - 1) * $perPage, $perPage),
            $latestOrders->count(),
            $perPage,
            $page,
            ['path' => url()->current()]
        );

        // Render the Blade partial with the orders data
//        dd($orders);

        $ordersTableHtml = View::make('admin.partials._newest_orders_table', ['orders' => $orders])->render();
        // Render pagination buttons using Blade components
        $paginationButtons = View::make('components.pagination-buttons', [
            'pagination' => $orders
        ])->render();
//        dd($paginationButtons);

        return response()->json([
            'orders_table_html' => $ordersTableHtml,
            'pagination_buttons' => $paginationButtons
        ]);
    }
    public function getBestSellingProducts(Request $request)
    {
        $perPage = 5; // Number of items per page
        $page = $request->query('page', 1); // Current page number
        $totalLimit = 20; // Total number of items to fetch

        // Fetch top products by quantity sold
        $topProducts = DB::table('product_details')
            ->select('product_id', DB::raw('SUM(qty) as total_quantity_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity_sold')
            ->limit($totalLimit)
            ->get();

        // Convert to collection
        $topProductsCollection = collect($topProducts);

        // Get current page items
        $currentPageItems = $topProductsCollection->slice(($page - 1) * $perPage, $perPage)->values();

        // Create LengthAwarePaginator instance
        $paginatedTopProducts = new LengthAwarePaginator(
            $currentPageItems,
            $topProductsCollection->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );


        // Render the Blade partial with the orders data
//        dd($orders);

        $productsTableHtml = View::make('admin.partials._top_products_table', ['t_products' => $paginatedTopProducts])->render();
//        dd($productsTableHtml);
        // Render pagination buttons using Blade components
        $paginationButtons = View::make('components.pagination-buttons', [
            'pagination' => $paginatedTopProducts
        ])->render();
//        dd($paginationButtons);

        return response()->json([
            'products_table_html' => $productsTableHtml,
            'pagination_buttons' => $paginationButtons
        ]);
    }

}
