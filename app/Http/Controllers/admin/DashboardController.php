<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalOrders = Order::where('delivery_status', '!=', 'cancelled')->count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalSale = Order::where('delivery_status', '!=', 'cancelled')->sum('grand_total');

        // Current Month
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $todayDate = Carbon::now()->format('Y-m-d');
        $currentMonthSale = Order::where('delivery_status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $startOfMonth)
            ->whereDate('created_at', '<=', $todayDate)
            ->sum('grand_total');

        // Last Month
        $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthName = Carbon::now()->subMonth()->startOfMonth()->format('M');
        $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $lastMonthSale = Order::where('delivery_status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $lastMonthStartDate)
            ->whereDate('created_at', '<=', $lastMonthEndDate)
            ->sum('grand_total');

        // last 30days
        $lastThirtyDayStartDate = Carbon::now()->subDays(30)->format('Y-m-d');
        $lastThirtyDaysSale = Order::where('delivery_status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $lastThirtyDayStartDate)
            ->whereDate('created_at', '<=', $todayDate)
            ->sum('grand_total');

        return view('admin.dashboard', [
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'totalCustomers' => $totalCustomers,
            'totalSale' => $totalSale,
            'currentMonthSale' => $currentMonthSale,
            'lastMonthSale' => $lastMonthSale,
            'lastMonthName' => $lastMonthName,
            'lastThirtyDaysSale' => $lastThirtyDaysSale,
        ]);
    }

}
