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
// Closure to handle the "not cancelled" condition
        $cancelledCondition = function ($query) {
            $query->where('delivery_status', '!=', 'cancelled');
        };

// Total Metrics
        $totalOrders = Order::where($cancelledCondition)->count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalSale = Order::where($cancelledCondition)->sum('grand_total');

// Current Month Sales
        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();
        $currentMonthSale = Order::where($cancelledCondition)
            ->whereBetween('created_at', [$startOfMonth, $today])
            ->sum('grand_total');

// Last Month Sales
        $lastMonth = $today->copy()->subMonth();
        $lastMonthStart = $lastMonth->startOfMonth();
        $lastMonthEnd = $lastMonth->endOfMonth();
        $lastMonthSale = Order::where($cancelledCondition)
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->sum('grand_total');
        $lastMonthName = $lastMonth->format('M');

// Last 30 Days Sales
        $lastThirtyDaysStart = $today->copy()->subDays(30);
        $lastThirtyDaysSale = Order::where($cancelledCondition)
            ->whereBetween('created_at', [$lastThirtyDaysStart, $today])
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
