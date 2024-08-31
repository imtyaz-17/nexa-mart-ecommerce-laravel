@extends('front.layouts.app')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                        <li class="breadcrumb-item">Settings</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">
            <div class="container  mt-5">
                <div class="row">
                    <div class="col-md-3">
                        @include('profile.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            @include('message')
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">My Wishlist</h2>
                            </div>
                            <div class="card-body p-4">
                                @if($wishlists->isNotEmpty())
                                    @foreach($wishlists as $wishlist)
                                        @php
                                            $productImage = $wishlist->product->productImages->first();
                                        @endphp
                                        <div
                                            class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                            <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                                                <a class="d-block flex-shrink-0 mx-auto me-sm-4"
                                                   href="{{route('product', $wishlist->product->slug)}}"
                                                   style="width: 10rem;">
                                                    @if(!empty($productImage->image))
                                                        <img style="width: 8rem; height: 5rem"
                                                             src="{{asset('uploads/productImage/thumb/'.$productImage->image)}}"
                                                             alt="">
                                                    @else
                                                        <img
                                                            src="{{asset('admin-assets/img/default-150x150.png')}}"
                                                            alt="">
                                                    @endif
                                                </a>
                                                <div class="pt-2">
                                                    <h3 class="product-title fs-base mb-2"><a
                                                            href="{{route('product', $wishlist->product->slug)}}">{{$wishlist->product->title}}</a>
                                                    </h3>
                                                    <div class="fs-lg text-accent pt-2">
                                                        <span class="h5"><strong>${{$wishlist->product->price}}</strong></span>
                                                        @if($wishlist->product->compare_price>0)
                                                            <span class="h6 text-underline"><del>${{$wishlist->product->compare_price}}</del></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                                <form
                                                    action="{{ route('profile.remove-from-wishlist', $wishlist->id) }}"
                                                    method="POST"
                                                    style="display:inline;" onsubmit="return confirmDeletion();">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm" type="submit"><i
                                                            class="fas fa-trash-alt me-2"></i>Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom text-center alert alert-info">
                                        <h3 class="product-title fs-base mb-2">You did not add anything..</h3>
                                    </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>
    </main>
@endsection
@section('customJs')
    <script type="text/javascript">
        function confirmDeletion() {
            return confirm('Are you sure you want to remove this? This action cannot be undone.');
        }
    </script>
@endsection
