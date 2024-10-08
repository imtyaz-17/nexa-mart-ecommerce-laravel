@extends('front.layouts.app')

@section('content')
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
             data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                    <picture>
                        <source media="(max-width: 799px)"
                                srcset="{{asset('frontend-assets/images/carousel-1-m.jpg')}}"/>
                        <source media="(min-width: 800px)" srcset="{{asset('frontend-assets/images/carousel-1.jpg')}}"/>
                        <img src="images/carousel-1.jpg" alt=""/>
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Kids Fashion</h1>
                            <p class="mx-md-5 px-5">Explore our latest collection of stylish and comfortable kids'
                                clothing.
                                Perfect for every occasion, designed with love.</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('shop')}}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <picture>
                        <source media="(max-width: 799px)"
                                srcset="{{asset('frontend-assets/images/carousel-2-m.jpg')}}"/>
                        <source media="(min-width: 800px)" srcset="{{asset('frontend-assets/images/carousel-2.jpg')}}"/>
                        <img src="{{asset('frontend-assets/images/carousel-2.jpg')}}" alt=""/>
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Womens Fashion</h1>
                            <p class="mx-md-5 px-5">Discover the latest trends in women's fashion. From chic dresses to
                                casual wear, find the perfect outfit for any occasion.</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('shop')}}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <!-- <img src="images/carousel-3.jpg" class="d-block w-100" alt=""> -->

                    <picture>
                        <source media="(max-width: 799px)"
                                srcset="{{asset('frontend-assets/images/carousel-3-m.jpg')}}"/>
                        <source media="(min-width: 800px)" srcset="{{asset('frontend-assets/images/carousel-3.jpg')}}"/>
                        <img src="{{asset('frontend-assets/images/carousel-2.jpg')}}" alt=""/>
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Branded Clothes</h1>
                            <p class="mx-md-5 px-5">Enjoy massive discounts on top brands. Shop now and save big on your
                                favorite fashion items!</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('shop')}}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Quality Product</h2>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">24/7 Support</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-3">
        <div class="container">
            <div class="section-title">
                <h2>Categories</h2>
            </div>
            <div class="row pb-3">
                @if($categories->isNotEmpty())
                    @foreach($categories as $category)
                        <div class="col-lg-3">
                            <div class="cat-card">
                                <div class="left">
                                    @if(!empty($category->image))
                                        <img src="{{asset('uploads/categoryImage/thumb/'.$category->image)}}" alt=""
                                             class="img-fluid">
                                    @endif
                                </div>
                                <div class="right">
                                    <div class="cat-data">
                                        <h2>{{$category->name}}</h2>
                                        {{--                                        <p>100 Products</p>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Featured Products</h2>
            </div>
            <div class="row pb-3">
                @if($featureProducts->isNotEmpty())
                    @foreach($featureProducts as $featureProduct)
                        @php
                            $featureProductImage = $featureProduct->productImages->first();
                        @endphp
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{route('product', $featureProduct->slug)}}" class="product-img">
                                        @if(!empty($featureProductImage->image))
                                            <img class="card-img-top"
                                                 src="{{asset('uploads/productImage/'.$featureProductImage->image)}}"
                                                 alt="">
                                        @else
                                            <img class="card-img-top"
                                                 src="{{asset('admin-assets/img/default-150x150.png')}}"
                                                 alt="">
                                        @endif
                                    </a>
                                    <a onclick="addToWishlist({{$featureProduct->id}})" class="whishlist"
                                       href="javascript:void(0)"><i class="far fa-heart"></i></a>

                                    <div class="product-action">
                                        @if($featureProduct->qty>0)
                                            <form action="{{ route('cart.add', $featureProduct->id) }}" method="POST"
                                                  class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-dark">
                                                    <i class="fas fa-shopping-cart"></i> &nbsp;ADD TO CART
                                                </button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-dark">
                                                <i class="fas fa-shopping-cart"></i> &nbsp;Out Of Stock!
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link"
                                       href="{{route('product', $featureProduct->slug)}}">{{$featureProduct->title}}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>${{$featureProduct->price}}</strong></span>
                                        @if($featureProduct->compare_price>0)
                                            <span class="h6 text-underline"><del>${{$featureProduct->compare_price}}</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Latest Products</h2>
            </div>
            <div class="row pb-3">
                @if($latestProducts->isNotEmpty())
                    @foreach($latestProducts as $latestProduct)
                        @php
                            $latestProductImage = $latestProduct->productImages->first();
                        @endphp
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{route('product', $latestProduct->slug)}}" class="product-img">
                                        @if(!empty($latestProductImage->image))
                                            <img class="card-img-top"
                                                 src="{{asset('uploads/productImage/'.$latestProductImage->image)}}"
                                                 alt="">
                                        @else
                                            <img class="card-img-top"
                                                 src="{{asset('admin-assets/img/default-150x150.png')}}"
                                                 alt="">
                                        @endif
                                    </a>
                                    <a onclick="addToWishlist({{$latestProduct->id}})" class="whishlist"
                                       href="javascript:void(0)"><i class="far fa-heart"></i></a>

                                    <div class="product-action">
                                        @if($latestProduct->qty>0)
                                            <form action="{{ route('cart.add', $latestProduct->id) }}" method="POST"
                                                  class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-dark">
                                                    <i class="fas fa-shopping-cart"></i> &nbsp;ADD TO CART
                                                </button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-dark">
                                                <i class="fas fa-shopping-cart"></i> &nbsp;Out Of Stock!
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link"
                                       href="{{route('product', $latestProduct->slug)}}">{{$latestProduct->title}}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>${{$latestProduct->price}}</strong></span>
                                        @if($latestProduct->compare_price>0)
                                            <span class="h6 text-underline"><del>${{$latestProduct->compare_price}}</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

@endsection
