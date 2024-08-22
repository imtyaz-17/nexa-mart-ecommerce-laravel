@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Discount Coupons</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('admin.coupons.create')}}" class="btn btn-primary">New Coupon</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @include('message')
            <div class="card">
                <form action="" method="GET">
                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" onclick="window.location.href='{{route('admin.coupons.index')}}'"
                                    class="btn btn-default btn-sm">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" name="keyword" value="{{ request()->get('keyword') }}"
                                       class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Max Uses</th>
{{--                            <th>Max Uses User</th>--}}
{{--                            <th>Type</th>--}}
                            <th>Discount</th>
                            <th>Min Purchased</th>
                            <th>Starts At</th>
                            <th>Ends at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($coupons->isNotEmpty())
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{$coupon->id}}</td>
                                    <td>{{$coupon->code}}</td>
                                    <td>{{$coupon->name}}</td>
                                    <td>{{$coupon->description}}</td>
                                    <td>{{$coupon->max_uses}}</td>
{{--                                    <td>{{$coupon->max_uses_user}}</td>--}}
{{--                                    <td>{{$coupon->type}}</td>--}}
                                    @if($coupon->type=='percent')
                                        <td>{{$coupon->discount}}%</td>
                                    @else
                                        <td>${{$coupon->discount}}</td>
                                    @endif
                                    <td>{{$coupon->min_purchased}}</td>
                                    <td>{{(!empty($coupon->starts_at))?\Carbon\Carbon::parse($coupon->starts_at)->format('Y/m/d H:i:s'):''}}</td>
                                    <td>{{(!empty($coupon->ends_at))?\Carbon\Carbon::parse($coupon->ends_at)->format('Y/m/d H:i:s'):''}}</td>
                                    @if($coupon->status)
                                        <td>
                                            <svg class="text-success-500 h-6 w-6 text-success"
                                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </td>
                                    @else
                                        <td>
                                            <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                                 fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                 aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </td>
                                    @endif

                                    <td>
                                        <a href="{{route('admin.coupons.edit', $coupon->id)}}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.coupons.delete', $coupon->id) }}" method="POST"
                                              style="display:inline;" onsubmit="return confirmDeletion();">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger w-4 h-4 mr-1"
                                                    style="background: none; border: none; cursor: pointer;"
                                                    aria-label="Delete">
                                                <svg class="filament-link-icon w-4 h-4 mr-1"
                                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4
                                                               a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="alert alert-danger text-center" colspan="5">Records Not Found !!</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{$coupons->links()}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customJs')
    <script type="text/javascript">
        function confirmDeletion() {
            return confirm('Are you sure you want to delete this coupon? This action cannot be undone.');
        }
    </script>
@endsection