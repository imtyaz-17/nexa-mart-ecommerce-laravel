@extends('front.layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 text-center py-5">
{{--            @include('message')--}}
            <h1 class="display-4 font-weight-bold text-success">Order Completed Successfully!</h1>
            <p class="lead mt-4">Thank you for your purchase. Your order has been processed and will be shipped shortly.</p>
            <p class="mt-3">You will receive a confirmation email with your order details soon. If you have any questions, feel free to <a href="#" class="text-primary">contact us</a>.</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-4">Return to Home</a>
        </div>
    </div>
@endsection
