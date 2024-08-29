<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="email-container">
    @if($mailData['userType']=='customer')
        <h1 class="text-primary text-center">Thank You for Your Order!</h1>
        <div class="email-content">
            <h2>Order Confirmation - Order #{{$mailData['order']->id}}</h2>
            {{--        <p>Dear {{$mailData['order']->customer_name}},</p>--}}
            <p>We are pleased to confirm your order. Below are the details of your purchase:</p>
        </div>
    @else
        <h1 class="text-primary text-center">New Order Received!</h1>
        <div class="email-content">
            <h2>Order Confirmation - Order #{{$mailData['order']->id}}</h2>
        </div>
    @endif
    <div>
        <h2 class="mb-3">Shipping Address</h2>
        <address>
            <strong>{{$mailData['order']->first_name.' '.$mailData['order']->last_name}}</strong><br>
            {{$mailData['order']->address}}, {{$mailData['order']->apartment}}<br>
            {{$mailData['order']->city}}, {{$mailData['order']->zip}} {{$mailData['order']->country_name}}
            <br>
            Phone: {{$mailData['order']->mobile}}<br>
            Email: {{$mailData['order']->email}}
        </address>
    </div>
    <h2>Order Details</h2>
    <table class="table">
        <thead class="table-info">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($mailData['order']->orderItems as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>${{number_format($item->price, 2)}}</td>
                <td>{{$item->qty}}</td>
                <td>${{number_format($item->total, 2)}}</td>
            </tr>
        @endforeach
        <tr>
        </tr>
        <tr>
            <th colspan="3" class="text-end">Subtotal:</th>
            <td class="fw-bold">${{number_format($mailData['order']->subtotal, 2)}}</td>
        </tr>
        <tr>
            <th colspan="3" class="text-end">Discount:</th>
            <td class="fw-bold">- ${{number_format($mailData['order']->discount, 2)}}</td>
        </tr>
        <tr>
            <th colspan="3" class="text-end">Shipping:</th>
            <td class="fw-bold">${{number_format($mailData['order']->shipping, 2)}}</td>
        </tr>
        <tr>
            <th colspan="3" class="text-end">Grand Total:</th>
            <td class="fw-bold">${{number_format($mailData['order']->grand_total, 2)}}</td>
        </tr>
        </tbody>
    </table>

    <div class="mt-3 text-secondary text-center">
        <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>
        <p>Thank you for choosing us!</p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
