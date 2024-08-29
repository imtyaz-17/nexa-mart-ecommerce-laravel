<?php

use App\Mail\OrderEmail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

function orderEmail($orderId)
{
    $order = Order::where('orders.id', $orderId)
        ->with('orderItems')
        ->leftJoin('customer_addresses', 'customer_addresses.id', '=', 'orders.customer_address_id')
        ->leftJoin('countries', 'countries.id', '=', 'customer_addresses.country_id')
        ->select('orders.*', 'customer_addresses.*', 'countries.name as country_name')
        ->first();

    $mailData = [
        'subject' => 'Thank you for your order',
        'order' => $order,
    ];
//    dd($order);
    Mail::to($order->email)->send(new OrderEmail($mailData));
}
