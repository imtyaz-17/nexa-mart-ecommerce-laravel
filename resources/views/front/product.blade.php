@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('shop')}}">Shop</a></li>
                    <li class="breadcrumb-item">{{$product->title}}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">
                            @if($product->productImages)
                                @foreach($product->productImages as $key => $productImage)
                                    <div class="carousel-item {{($key==0) ? 'active' : ''}}">
                                        <img class="w-100 h-100"
                                             src="{{asset('uploads/productImage/'.$productImage->image)}}" alt="Image">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    @if(session('errorCart'))
                        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center"
                             role="alert">
                            <div>
                                <strong>{{ session('errorCart') }}</strong>
                            </div>
                            <a href="{{ route('cart') }}" class="ml-4 d-flex">
                                &nbsp; View Cart<i class="fas fa-shopping-cart text-primary pt-1"></i>
                            </a>
                        </div>
                    @endif
                    <div class="bg-light right">
                        <h1>{{$product->title}}</h1>
                        @php
                            if ($avgRating>0)
                                 $avgRatingPercentage = ($avgRating / 5) * 100;
                            else
                                $avgRatingPercentage =0;
                        @endphp
                        <div class="d-flex mb-3">
                            <div class="back-stars mr-2 pt-1">
                                @for($i = 0; $i < 5; $i++)
                                    <small> <i class="fa fa-star" aria-hidden="true"></i></small>
                                @endfor
                                <div class="front-stars pt-1"
                                     style="width: {{ $avgRatingPercentage }}%">
                                    @for($i = 0; $i < 5; $i++)
                                        <small> <i class="fa fa-star" aria-hidden="true"></i></small>
                                    @endfor
                                </div>
                            </div>
                            <small
                                class="pt-1 ps-1">( {{($product->product_ratings_count>1)? $product->product_ratings_count.' Reviews':$product->product_ratings_count.' Review'}}
                                )</small>
                        </div>
                        @if($product->compare_price>0)
                            <h2 class="price text-secondary">
                                <del>${{$product->compare_price}}</del>
                            </h2>
                        @endif
                        <h2 class="price ">${{$product->price}}</h2>

                        <p>{!! $product->short_description !!} </p>
                        @if($product->qty>0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST"
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
                <div class="col-md-12 mt-5">
                    <div class="bg-light">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link {{ session('success') ||session('error')|| $errors->any() ? '' : 'active' }}"
                                    id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab"
                                    aria-controls="description" aria-selected="true">Description
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab"
                                        data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping"
                                        aria-selected="false">Shipping & Returns
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link {{ session('success')||session('error') || $errors->any()? 'active' : '' }}"
                                    id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                    type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div
                                class="tab-pane fade {{ session('success')||session('error') || $errors->any() ? '' : 'show active' }}"
                                id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <p>
                                    {!! $product->description !!}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                <p>{!! $product->shipping_returns !!}</p>
                            </div>
                            <div
                                class="tab-pane fade {{ session('success')||session('error') || $errors->any()? 'show active' : '' }}"
                                id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="col-md-8">
                                    <div class="row">
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
                                        <form method="post" action="{{route('product.rating',$product->id)}}">
                                            @csrf
                                            <h3 class="h4 pb-3 font-bold">Write a Review</h3>
                                            <div class="form-group mb-3">
                                                <label for="rating">Rating</label>
                                                <br>
                                                <div class="rating @error('rating') is-invalid @enderror"
                                                     style="width: 10rem">
                                                    <input id="rating-5" type="radio" name="rating" value="5"/><label
                                                        for="rating-5"><i class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-4" type="radio" name="rating" value="4"/><label
                                                        for="rating-4"><i class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-3" type="radio" name="rating" value="3"/><label
                                                        for="rating-3"><i class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-2" type="radio" name="rating" value="2"/><label
                                                        for="rating-2"><i class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-1" type="radio" name="rating" value="1"/><label
                                                        for="rating-1"><i class="fas fa-3x fa-star"></i></label>
                                                </div>
                                                @error('rating')
                                                <p class="invalid-feedback d-block">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="">How was your overall experience?</label>
                                                <textarea name="comment" id="comment"
                                                          class="form-control  @error('comment') is-invalid @enderror"
                                                          cols="30"
                                                          rows="10"
                                                          placeholder="How was your overall experience?"></textarea>
                                                @error('comment')
                                                <p class="invalid-feedback">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div>
                                                <button class="btn btn-dark">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <div class="overall-rating mb-3">
                                        <div class="d-flex">
                                            <h1 class="h3 pe-3">{{$avgRating}}</h1>
                                            <div class="star-rating mt-2" title="">
                                                <div class="back-stars">
                                                    @for($i = 0; $i < 5; $i++)
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    @endfor
                                                    <div class="front-stars"
                                                         style="width: {{ $avgRatingPercentage }}%">
                                                        @for($i = 0; $i < 5; $i++)
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-2 ps-2">
                                                ({{($product->product_ratings_count>1)? $product->product_ratings_count.' Reviews':$product->product_ratings_count.' Review'}}
                                                )
                                            </div>
                                        </div>
                                    </div>
                                    @if($product->productRatings->isNotEmpty())
                                        @foreach($product->productRatings as $rating)
                                            @php
                                                $ratingPercentage = ($rating->rating / 5) * 100;
                                            @endphp
                                            <div class="rating-group mb-4">
                                                <span><strong>{{ $rating->user->name}}</strong></span>
                                                <!-- Assuming the user relationship -->
                                                <div class="star-rating mt-2" title="">
                                                    <div class="back-stars">
                                                        @for($i = 0; $i < 5; $i++)
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        @endfor
                                                        <div class="front-stars"
                                                             style="width: {{ $ratingPercentage }}%">
                                                            @for($i = 0; $i < 5; $i++)
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($rating->comment)
                                                    <div class="my-3">
                                                        <p>{{ $rating->comment }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($relatedProducts->isNotEmpty())
        <section class="pt-5 section-8">
            <div class="container">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
                <div class="col-md-12">
                    <div id="related-products" class="carousel">
                        @foreach($relatedProducts as $relatedProduct)
                            @php
                                $relatedProductImage = $relatedProduct->productImages->first();;
                            @endphp
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    @if(!empty($relatedProductImage->image))
                                        <a href="" class="product-img"><img class="card-img-top"
                                                                            src="{{asset('uploads/productImage/thumb/'.$relatedProductImage->image)}}"
                                                                            alt=""></a>
                                    @else
                                        <a href="" class="product-img"><img class="card-img-top"
                                                                            src="{{asset('admin-assets/img/default-150x150.png')}}"
                                                                            alt=""></a>
                                    @endif
                                    <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                    <div class="product-action">
                                        <a class="btn btn-dark" href="{{route('cart.add', $relatedProduct->id)}}">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="">{{$relatedProduct->title}}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>${{$relatedProduct->price}}</strong></span>
                                        @if($relatedProduct->compare_price > 0)
                                            <span class="h6 text-underline"><del>${{$relatedProduct->compare_price}}</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
@section('customJs')
    <script type="text/javascript">

    </script>
@endsection
