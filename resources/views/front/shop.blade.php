@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Categories</h2>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                @if($categories->isNotEmpty())
                                    @foreach($categories as $key=>$category)
                                        <div class="accordion-item">
                                            @if($category->subcategories ->isNotEmpty())
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne-{{$key}}"
                                                            aria-expanded="false" aria-controls="collapseOne-{{$key}}">
                                                        {{$category->name}}
                                                    </button>
                                                </h2>
                                            @else
                                                <a href="{{route('shop', $category->slug)}}"
                                                   class="nav-item nav-link {{($categorySelected == $category->id)?'text-primary':''}}">{{$category->name}}</a>
                                            @endif
                                            @if($category->subcategories->isNotEmpty())
                                                <div id="collapseOne-{{$key}}"
                                                     class="accordion-collapse collapse {{($categorySelected == $category->id)?'show':''}}"
                                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample"
                                                     style="">
                                                    <div class="accordion-body">
                                                        <div class="navbar-nav">
                                                            @foreach($category->subcategories as $subcategory)
                                                                <a href="{{route('shop',[$category->slug,$subcategory->slug])}}"
                                                                   class="nav-item nav-link {{($subcategorySelected == $subcategory->id)?'text-primary':''}}">{{$subcategory->name}}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Brand</h2>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @if($brands->isNotEmpty())
                                @foreach($brands as $brand)
                                    <div class="form-check mb-2">
                                        <input
                                            {{(in_array($brand->id, $brandsArray)) ? 'checked':''}} class="form-check-input brand-label"
                                            type="checkbox" name="brand[]"
                                            value="{{$brand->id}}" id="brand-{{$brand->id}}">
                                        <label class="form-check-label" for="brand-{{$brand->id}}">
                                            {{$brand->name}}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Price</h2>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="js-range-slider" name="my_range" value=""/>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                <div class="ml-2">
                                    <div class="form-group">
                                        <select id="sort-by" class="form-control">
                                            <option value="latest" {{($sortBy == 'latest')?'selected':''}}>Latest
                                            </option>
                                            <option value="price_desc" {{($sortBy == 'price_desc')?'selected':''}}>Price High</option>
                                            <option value="price_asc" {{($sortBy == 'price_asc')?'selected':''}}>Price Low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($products->isNotEmpty())
                            @foreach($products as $product)
                                @php
                                    $productImage = $product->productImages->first();
                                @endphp
                                <div class="col-md-4">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">
                                            <a href="{{route('product', $product->slug)}}" class="product-img">
                                                @if(!empty($productImage->image))
                                                    <img class="card-img-top"
                                                         src="{{asset('uploads/productImage/thumb/'.$productImage->image)}}"
                                                         alt="">
                                                @else
                                                    <img class="card-img-top"
                                                         src="{{asset('admin-assets/img/default-150x150.png')}}"
                                                         alt="">
                                                @endif
                                            </a>
                                            <a onclick="addToWishlist({{$product->id}})" class="whishlist" href="javascript:void(0)"><i class="far fa-heart"></i></a>

                                            <div class="product-action">
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
                                        <div class="card-body text-center mt-3">
                                            <a class="h6 link" href="{{route('product', $product->slug)}}">{{$product->title}}</a>
                                            <div class="price mt-2">
                                                <span class="h5"><strong>${{$product->price}}</strong></span>
                                                @if($product->compare_price>0)
                                                    <span class="h6 text-underline"><del>${{$product->compare_price}}</del></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="col-md-12 pt-5">
                            {{$products->withQueryString()->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script type="text/javascript">
        rangeSlider = $(".js-range-slider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 1000,
            from: {{$priceMin}},
            step: 10,
            to: {{$priceMax}},
            skin: "round",
            max_postfix: "+",
            prefix: "$",
            onFinish: function () {
                apply_filters()
            }
        });
        var slider = $(".js-range-slider").data("ionRangeSlider");

        // brand filter
        $(".brand-label").change(function () {
            apply_filters();
        })

        // Sorting
        $("#sort-by").change(function () {
            apply_filters();
        });

        function apply_filters() {
            let brands = [];
            $(".brand-label").each(function () {
                if ($(this).is(":checked") == true) {
                    brands.push($(this).val())
                }
            });
            let url = '{{url()->current()}}?';

            // Brand Filter
            if (brands.length > 0) {
                url += '&brands=' + brands.toString();
            }

            // Price range Filter
            url += '&price_min=' + slider.result.from + '&price_max=' + slider.result.to;

            // Sorting Filter
            url+='&sort-by='+$('#sort-by').val();

            //search
            let keyword =$("#search").val();
            if(keyword.length>0){
                url+='&search='+keyword;
            }

            window.location.href = url;
        }
    </script>
@endsection
