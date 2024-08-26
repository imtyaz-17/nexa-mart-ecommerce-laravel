@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('shop')}}">Shop</a></li>
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <form action="{{route('cart.process-checkout')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="sub-title">
                            <h2>Shipping Address</h2>
                        </div>
                        <div class="card shadow-lg border-0">
                            <div class="card-body checkout-form">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="first_name" id="first_name"
                                                   value="{{ old('first_name', $customerAddress->first_name ?? '') }}"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   placeholder="First Name">
                                            @error('first_name')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="last_name" id="last_name"
                                                   value="{{ old('last_name', $customerAddress->last_name ?? '') }}"
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   placeholder="Last Name">
                                            @error('last_name')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="email" id="email"
                                                   value="{{ old('email', $customerAddress->email ?? '') }}"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Email">
                                            @error('email')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <select name="country" id="country"
                                                    class="form-control @error('country') is-invalid @enderror">
                                                <option value="">Select a Country</option>
                                                @if($countries->isNotEmpty())
                                                    )
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            @selected(!empty($customerAddress) && $customerAddress->country_id == $country->id)>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('country')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                        <textarea name="address" id="address" cols="30" rows="3" placeholder="Address"
                                                  class="form-control @error('address') is-invalid @enderror">{{ old('address', $customerAddress->address ?? '') }}</textarea>
                                            @error('address')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="apartment" id="apartment"
                                                   value="{{ old('apartment', $customerAddress->apartment ?? '') }}"
                                                   class="form-control @error('apartment') is-invalid @enderror"
                                                   placeholder="Apartment, suite, unit, etc. (optional)">
                                            @error('apartment')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" name="city" id="city"
                                                   value="{{ old('city', $customerAddress->city ?? '') }}"
                                                   class="form-control @error('city') is-invalid @enderror"
                                                   placeholder="City">
                                            @error('city')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" name="state" id="state"
                                                   value="{{ old('state', $customerAddress->state ?? '') }}"
                                                   class="form-control @error('state') is-invalid @enderror"
                                                   placeholder="State">
                                            @error('state')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" name="zip" id="zip"
                                                   value="{{ old('zip', $customerAddress->zip ?? '') }}"
                                                   class="form-control @error('zip') is-invalid @enderror"
                                                   placeholder="Zip">
                                            @error('zip')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="mobile" id="mobile"
                                                   value="{{ old('mobile', $customerAddress->mobile ?? '') }}"
                                                   class="form-control @error('mobile') is-invalid @enderror"
                                                   placeholder="Mobile No.">
                                            @error('mobile')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                        <textarea name="order_notes" id="order_notes" cols="30" rows="2"
                                                  placeholder="Order Notes (optional)"
                                                  class="form-control @error('order_notes') is-invalid @enderror">{{ old('order_notes', $customerAddress->order_notes ?? '') }}</textarea>
                                            @error('order_notes')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sub-title">
                            <h2>Order Summery</h2>
                        </div>
                        <div class="card cart-summery">
                            <div class="card-body">
                                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $item)
                                    <div class="d-flex justify-content-between pb-2">
                                        <div class="h6">{{$item->name}} X {{$item->qty}}</div>
                                        <div class="h6">${{$item->price * $item->qty}}</div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-between summery-end">
                                    <div class="h6"><strong>Subtotal</strong></div>
                                    <div class="h6">
                                        <strong>${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</strong></div>
                                </div>
                                <div class="d-flex justify-content-between summery-end">
                                    <div class="h6"><strong>Discount</strong></div>
                                    <div class="h6">
                                        <strong id="discount_field">${{number_format($discount,2)}}</strong></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div class="h6"><strong>Shipping</strong></div>
                                    <input type="hidden" name="shipping" id="shipping"
                                           value="{{ number_format($shippingCharge, 2) }}">
                                    <div class="h6"><strong
                                            id="shippingCharge">${{number_format($shippingCharge,2)}}</strong></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 summery-end">
                                    <div class="h5"><strong>Total</strong></div>
                                    <div class="h5">
                                        <strong id="grandTotal">${{number_format($grandTotal,2)}}</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group apply-coupon mt-4">
                            <input type="text" name="discount_code" id="discount_code" placeholder="Coupon Code"
                                   class="form-control">
                            <button class="btn btn-dark" type="button" id="apply-discount">Apply Coupon</button>
                        </div>
                        <div id="coupon-close-wrapper">
                            @if(Session::has('code'))
                                <div class="mt-2" id="coupon-close">
                                    <strong>{{\Illuminate\Support\Facades\Session::get('code')->code}}</strong>
                                    <a class="btn btn-sm btn-danger" id="remove-discount"><i
                                            class="fa fa-times"></i></a>
                                </div>
                            @endif
                        </div>

                        <div class="card payment-form ">
                            <h3 class="card-title h5 mb-3">Payment Method</h3>
                            <div class="">
                                <input type="radio" name="payment_method" value="cod" id="payment_method_one" checked>
                                <label for="payment_method_one" class="form-check-label">Cash On Delivery</label>
                            </div>
                            <div class="">
                                <input type="radio" name="payment_method" value="cod" id="payment_method_two">
                                <label for="payment_method_two" class="form-check-label">Card Payment</label>
                            </div>
                            <div class="card-body p-0 mt-3 d-none" id="card-payment-form">
                                <div class="mb-3">
                                    <label for="card_number" class="mb-2">Card Number</label>
                                    <input type="text" name="card_number" id="card_number"
                                           placeholder="Valid Card Number"
                                           class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="expiry_date" class="mb-2">Expiry Date</label>
                                        <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="expiry_date" class="mb-2">CVV Code</label>
                                        <input type="text" name="expiry_date" id="expiry_date" placeholder="123"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                            </div>
                        </div>
                        <!-- CREDIT CARD FORM ENDS HERE -->
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('customJs')
    <script type="text/javascript">
        $("#country").change(function () {
            $.ajax({
                url: '{{route("cart.get-order-summery")}}',
                type: 'POST',
                data: {country_id: $(this).val()},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                success: function (response) {
                    if (response.status == true) {
                        $("#shippingCharge").html('$' + response.shippingCharge);
                        $("#grandTotal").html('$' + response.grandTotal);
                        $("#shipping").val(response.shippingCharge);

                    }
                }

            });
        });
        $("#apply-discount").click(function () {
            $.ajax({
                url: '{{route("cart.apply-discount")}}',
                type: 'POST',
                data: {code: $("#discount_code").val(), country_id: $("#country").val()},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                success: function (response) {
                    if (response.status == true) {
                        $("#shippingCharge").html('$' + response.shippingCharge);
                        $("#grandTotal").html('$' + response.grandTotal);
                        $("#shipping").val(response.shippingCharge);
                        $("#discount_field").html('$' + response.discount);
                        $("#discount_code").val('');

                        $("#coupon-close-wrapper").html(response.discountString);
                    }
                    else{
                        $("#coupon-close-wrapper").html("<span class='text-danger'>"+response.error+"</span>");
                    }
                }
            });
        });
        $('body').on('click',"#remove-discount",function () {
            $.ajax({
                url: '{{route("cart.remove-coupon")}}',
                type: 'POST',
                data: {country_id: $("#country").val()},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                success: function (response) {
                    if (response.status == true) {
                        $("#shippingCharge").html('$' + response.shippingCharge);
                        $("#grandTotal").html('$' + response.grandTotal);
                        $("#shipping").val(response.shippingCharge);
                        $("#discount_field").html('$' + response.discount);

                        $("#coupon-close").html('');
                    }
                }
            });
        });
        $("#payment_method_one").click(function () {
            if ($(this).is(":checked") == true) {
                $("#card-payment-form").addClass('d-none');
            }
        });
        $("#payment_method_two").click(function () {
            if ($(this).is(":checked") == true) {
                $("#card-payment-form").removeClass('d-none');
            }
        });
    </script>
@endsection
