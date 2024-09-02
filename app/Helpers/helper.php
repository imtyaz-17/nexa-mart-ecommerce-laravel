<?php

use App\Mail\OrderEmail;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

function getCategories()
{
    return Category::where('status', 1)
        ->with('subcategories')
        ->orderBy('name', 'ASC')->get();
}

function orderEmail($orderId, $userType = "customer")
{
    $order = Order::where('orders.id', $orderId)
        ->with('orderItems')
        ->leftJoin('customer_addresses', 'customer_addresses.id', '=', 'orders.customer_address_id')
        ->leftJoin('countries', 'countries.id', '=', 'customer_addresses.country_id')
        ->select('orders.*', 'customer_addresses.*', 'countries.name as country_name')
        ->first();
    if ($userType == "customer") {
        $subject = 'Thank you for your order';
        $email = $order->email;
    } else {
        $subject = 'New Order Placed';
        $email = User::where('role', 'admin')->first()->email;
    }
    $mailData = [
        'subject' => $subject,
        'order' => $order,
        'userType' => $userType
    ];
    Mail::to($email)->send(new OrderEmail($mailData));
}
