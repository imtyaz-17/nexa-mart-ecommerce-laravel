@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order: #{{$order->id}}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    @include('message')
                    <div class="card">
                        <div class="card-header pt-3">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <h1 class="h5 mb-3">Shipping Address</h1>
                                    <address>
                                        <strong>{{$shippingInfo->first_name.' '.$shippingInfo->last_name}}</strong><br>
                                        {{$shippingInfo->address}}, {{$shippingInfo->apartment}}<br>
                                        {{$shippingInfo->city}}, {{$shippingInfo->zip}} {{$shippingInfo->countryName}}
                                        <br>
                                        Phone: {{$shippingInfo->mobile}}<br>
                                        Email: {{$shippingInfo->email}}
                                    </address>
                                    <strong>Shipped Date</strong><br>
                                    @if(!empty($order->shipped_date))
                                        {{\Carbon\Carbon::parse($order->shipped_date)->format('d M, Y')}}
                                    @else
                                        N/A
                                    @endif

                                </div>
                                <div class="col-sm-4 invoice-col">
                                    {{--                                    <b>Invoice #007612</b><br>--}}
                                    <br>
                                    <b>Order ID:</b> {{$order->id}}<br>
                                    <b>Total:</b> ${{number_format($order->grand_total,2)}}<br>
                                    <b>Status:</b>
                                    @if($order->delivery_status=='pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($order->delivery_status=='shipped')
                                        <span class="badge bg-info">Shipped</span>
                                    @elseif($order->delivery_status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th width="100">Price</th>
                                    <th width="100">Qty</th>
                                    <th width="100">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($orderItems->isNotEmpty())
                                    @foreach($orderItems as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>${{number_format($item->price,2)}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>${{number_format($item->total,2)}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <th colspan="3" class="text-right">Subtotal:</th>
                                    <td>${{number_format($order->subtotal,2)}}</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Discount:</th>
                                    <td>${{number_format($order->discount,2)}}</td>
                                </tr>

                                <tr>
                                    <th colspan="3" class="text-right">Shipping:</th>
                                    <td>${{number_format($order->shipping,2)}}</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Grand Total:</th>
                                    <td>${{number_format($order->grand_total,2)}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <form action="{{route('admin.orders.change-status', $order->id)}}" method="POST" name="changeOrderStatusForm" id="changeOrderStatusForm">
                            @csrf
                            <div class="card-body">
                                <h2 class="h4 mb-3">Order Status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option
                                            value="pending" {{ $order->delivery_status == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option
                                            value="shipped" {{ $order->delivery_status == 'shipped' ? 'selected' : '' }}>
                                            Shipped
                                        </option>
                                        <option
                                            value="delivered" {{ $order->delivery_status == 'delivered' ? 'selected' : '' }}>
                                            Delivered
                                        </option>
                                        <option
                                            value="canceled" {{ $order->delivery_status == 'canceled' ? 'selected' : '' }}>
                                            Cancelled
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="shipped_date">Shipped Date</label>
                                    <input placeholder="Shipped Date" value="{{$order->shipped_date}}" name="shipped_date" id="shipped_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Send Inovice Email</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Customer</option>
                                    <option value="">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customJs')
    <script type="text/javascript">
        // DateTime Picker
        $(document).ready(function () {
            $('#shipped_date').datetimepicker({
                format: 'Y-m-d H:i:s',
                // Additional options can go here
            });
        });
    </script>
@endsection
