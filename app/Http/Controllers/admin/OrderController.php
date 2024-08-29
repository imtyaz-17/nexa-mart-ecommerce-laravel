<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::latest('orders.created_at')->select('orders.*', 'users.name','users.email','users.phone');
        $orders = $orders->leftJoin('users', 'users.id', 'orders.user_id');
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $orders = $orders->where('users.name', 'LIKE', "%{$keyword}%")
                ->orWhere('users.email', 'LIKE', "%{$keyword}%")
                ->orWhere('orders.id', 'LIKE', "%{$keyword}%");
        }
        $orders = $orders->paginate(10);

        return view('admin.orders.list', compact('orders'));
    }

    public function orderDetail(Order $order)
    {
        $shippingInfo=CustomerAddress::select('customer_addresses.*', 'countries.name as countryName')
            ->leftJoin('countries', 'countries.id', 'customer_addresses.country_id')
            ->where('customer_addresses.id', $order->customer_address_id)
            ->first();

        $orderItems= OrderItem::where('order_id', $order->id)->get();
        return view('admin.orders.order-details', compact('order','shippingInfo','orderItems'));
    }

    public function changeOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'shipped_date' => 'nullable|date',
        ]);
        $order->delivery_status = $request->status;
        $order->shipped_date= $request->shipped_date;
        $order->save();

        return redirect()->route('admin.orders.detail', $order->id)->with('success', 'Order Status Changed Successfully');
    }

    public function sendInvoiceEmail(Request $request, Order $order)
    {
        orderEmail($order->id, $request->userType);
        return redirect()->route('admin.orders.detail', $order->id)->with('success', 'Invoice Email Send Successfully');
    }
}
