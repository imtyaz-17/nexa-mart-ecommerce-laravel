@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('shop')}}">Shop</a></li>
                    <li class="breadcrumb-item">Cart</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-9 pt-4">
        <div class="container">
            <div class="row">
                @if(\Gloudemans\Shoppingcart\Facades\Cart::count()>0)
                    <div class="col-md-8">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {!! session('success') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {!! session('error') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table" id="cart">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cartContent as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(!empty($item->options->productImage->image))
                                                    <img
                                                        src="{{asset('uploads/productImage/thumb/'.$item->options->productImage->image)}}"
                                                        width="" height="" class="ml-3">
                                                @else

                                                    <img src="{{asset('admin-assets/img/default-150x150.png')}}"
                                                         width="" height="" class="ml-3">
                                                @endif
                                                <h2>{{$item->name}}</h2>
                                            </div>
                                        </td>
                                        <td>${{$item->price}}</td>
                                        <td>
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button
                                                        class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 subtraction"
                                                        data-id="{{$item->rowId}}">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text"
                                                       class="form-control form-control-sm  border-0 text-center"
                                                       value="{{$item->qty}}">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 addition"
                                                            data-id="{{$item->rowId}}">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            ${{$item->price * $item->qty}}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                    onclick="deleteFromCart('{{$item->rowId}}');"
                                            "><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card cart-summery">
                            <div class="sub-title">
                                <h2 class="bg-white">Cart Summery</h2>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Subtotal</div>
                                    <div>${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</div>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Shipping</div>
                                    <div>$0</div>
                                </div>
                                <div class="d-flex justify-content-between summery-end">
                                    <div>Total</div>
                                    <div>${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</div>
                                </div>
                                <div class="pt-5">
                                    <a href="{{route('cart.checkout')}}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="card cart-summery text-center">
                            <div>
                                <i class="fas fa-shopping-cart text-primary fs-4"></i>
                            </div>
                            <div class="card-body">
                                <h2>Cart is empty !!</h2>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script type="text/javascript">
        $('.addition').click(function () {
            var qtyElement = $(this).parent().prev(); // Qty Input
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue < 10) {
                var rowId = $(this).data('id');
                qtyElement.val(qtyValue + 1);
                var newQty = qtyElement.val();
                updateCart(rowId, newQty);
            }
        });

        $('.subtraction').click(function () {
            var qtyElement = $(this).parent().next();
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue > 1) {
                var rowId = $(this).data('id');
                qtyElement.val(qtyValue - 1);
                var newQty = qtyElement.val();
                updateCart(rowId, newQty);
            }
        });

        function updateCart(rowId, qty) {
            $.ajax({
                url: '{{route("cart.update")}}',
                type: 'post',
                data: {rowId: rowId, qty: qty},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                success: function (response) {
                    window.location.href = '{{route("cart")}}';
                }
            });
        }

        function deleteFromCart(rowId) {
            if (confirm('Are you sure, you want to remove it from cart ??')) {
                $.ajax({
                    url: '{{route("cart.remove")}}',
                    type: 'post',
                    data: {rowId: rowId},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    success: function (response) {
                        window.location.href = '{{route("cart")}}';
                    }
                });
            }
        }

    </script>
@endsection
