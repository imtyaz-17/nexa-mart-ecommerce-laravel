@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ratings</h1>
                </div>
                {{--                <div class="col-sm-6 text-right">--}}
                {{--                    <a href="{{route('admin.products.create')}}" class="btn btn-primary">New Product</a>--}}
                {{--                </div>--}}
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
                            <button type="button" onclick="window.location.href='{{route('admin.products.ratings')}}'"
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
                            <th width="60">ID</th>
                            <th>Product</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Rated By</th>
                            <th width="100">Status</th>
                            <th width="100">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($ratings->isNotEmpty())
                            @foreach($ratings as $rating)
                                {{--                                @php--}}
                                {{--                                    $productImage = $product->productImages->first();--}}
                                {{--                                @endphp--}}
                                <tr>
                                    <td>{{$rating->id}}</td>
                                    <td>{{$rating->productTitle}}</td>
                                    <td>{{$rating->rating}} <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    </td>
                                    <td>{{$rating->comment}}</td>
                                    <td></td>
                                    @if($rating->status==true)
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
                                        <form action="{{ route('admin.products.ratings-update', $rating->id) }}"
                                              method="POST" onsubmit="return confirmApproval();">
                                            @csrf
                                            <button type="submit" class="text-primary w-8 h-8 mr-1"
                                                    style="background: none; border: none; cursor: pointer;"
                                                    aria-label="Change Status">
                                                <i class="fas fa-thumbs-up"></i>
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
                    {{$ratings->links()}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    <script type="text/javascript">
        function confirmApproval() {
            return confirm('Are you sure you want to change the status of this rating?');
        }
    </script>
@endsection

