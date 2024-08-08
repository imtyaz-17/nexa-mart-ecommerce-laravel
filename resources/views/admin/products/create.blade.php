@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data"
                  id="category-form">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" value="{{old('title')}}"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   placeholder="Title">
                                            @error('title')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" name="slug" id="slug" value="{{old('slug')}}"
                                                   class="form-control @error('slug') is-invalid @enderror"
                                                   placeholder="Slug">
                                            @error('slug')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="short_description">Short Description</label>
                                            <textarea name="short_description" id="short_description"
                                                      cols="30" rows="10"
                                                      class="summernote @error('short_description') is-invalid @enderror"
                                                      placeholder="Short Description">{{old('short_description')}}</textarea>
                                            @error('short_description')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description"
                                                      cols="30" rows="10"
                                                      class="summernote @error('description') is-invalid @enderror"
                                                      placeholder="Description">{{old('description')}}</textarea>
                                            @error('description')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Shipping & Returns</label>
                                            <textarea name="shipping_returns" id="shipping_returns"
                                                      cols="30" rows="10"
                                                      class="summernote @error('shipping_returns') is-invalid @enderror"
                                                      placeholder="Shipping & Returns">{{old('shipping_returns')}}</textarea>
                                            @error('shipping_returns')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <input type="hidden" id="image_name" name="images">
                                <h2 class="h4 mb-3">Media</h2>
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" id="price" value="{{old('price')}}"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   placeholder="Price">
                                            @error('price')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="compare_price">Compare at Price</label>
                                            <input type="text" name="compare_price" id="compare_price"
                                                   value="{{old('compare_price')}}"
                                                   class="form-control @error('compare_price') is-invalid @enderror"
                                                   placeholder="Compare Price">
                                            @error('compare_price')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                            <p class="text-muted mt-3">
                                                To show a reduced price, move the product’s original price into Compare
                                                at price. Enter a lower value into Price.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sku">SKU (Stock Keeping Unit)</label>
                                            <input type="text" name="sku" id="sku" value="{{old('sku')}}"
                                                   class="form-control @error('sku') is-invalid @enderror"
                                                   placeholder="sku">
                                            @error('sku')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="barcode">Barcode</label>
                                            <input type="text" name="barcode" id="barcode" value="{{old('barcode')}}"
                                                   class="form-control @error('barcode') is-invalid @enderror"
                                                   placeholder="Barcode">
                                            @error('barcode')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="hidden" name="track_qty" value="no">
                                                <input
                                                    class="custom-control-input @error('track_qty') is-invalid @enderror"
                                                    type="checkbox" id="track_qty" name="track_qty" value="yes" checked>
                                                @error('track_qty')
                                                <p class="invalid-feedback">{{$message}}</p>
                                                @enderror
                                                <label for="track_qty" class="custom-control-label">Track
                                                    Quantity</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" min="0" name="qty" id="qty" value="{{old('qty')}}"
                                                   class="form-control @error('qty') is-invalid @enderror"
                                                   placeholder="Qty">
                                            @error('qty')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product status</h2>
                                <div class="mb-3">
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('status', '1') == '0' ? 'selected' : '' }}>Block
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4  mb-3">Product category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select name="category" id="category"
                                            class="form-control @error('category') is-invalid @enderror">
                                        <option value="">Select a category</option>
                                        @if($categories->isNotEmpty())
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="category">Sub category</label>
                                    <select name="sub_category" id="sub_category"
                                            class="form-control">
                                        <option value="">Select a sub category</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product brand</h2>
                                <div class="mb-3">
                                    <select name="brand" id="brand"
                                            class="form-control">
                                        <option value="">Select a brand</option>
                                        @if($brands->isNotEmpty())
                                            @foreach($brands as $brand)
                                                <option
                                                    value="{{$brand->id}}" {{ old('brand') == $brand->id ? 'selected' : '' }}>{{$brand->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured product</h2>
                                <div class="mb-3">
                                    <select name="is_featured" id="is_featured"
                                            class="form-control @error('is_featured') is-invalid @enderror">
                                        <option value="no" {{ old('is_featured', 'no') == 'no' ? 'selected' : '' }}>No
                                        </option>
                                        <option value="yes" {{ old('is_featured', 'no') == 'yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{route('admin.products.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
    <!-- DropZone -->
    <script src="{{asset('admin-assets/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <script type="text/javascript">
        {{--     Dynamic Slug Generation--}}
        document.addEventListener('DOMContentLoaded', function () {
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');

            titleInput.addEventListener('input', function () {
                let slug = titleInput.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
                slugInput.value = slug;
            });
        });

        // Dropzone Multiple File Uploader
        Dropzone.autoDiscover = false;
        document.addEventListener('DOMContentLoaded', function () {
            const dropzone = new Dropzone("#image", {
                url: "{{ route('image.upload', ['folder' => 'productImage']) }}",
                maxFiles: 10,
                paramName: 'image',
                addRemoveLinks: true,
                acceptedFiles: "image/jpeg,image/png,image/gif",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }, success: function (file, response) {
                    // Store the server response in the file object
                    file.serverName = response.image;
                    let imagesArray = $("#image_name").val() ? JSON.parse($("#image_name").val()) : [];
                    imagesArray.push(file.serverName);
                    $("#image_name").val(JSON.stringify(imagesArray));
                    console.log(imagesArray);
                },
                removedfile: function (file) {
                    let imagesArray = JSON.parse($("#image_name").val());
                    let imageName = file.serverName;
                    console.log(imageName);
                    let index = imagesArray.indexOf(imageName);
                    if (index !== -1) {
                        imagesArray.splice(index, 1);
                    }
                    $("#image_name").val(JSON.stringify(imagesArray));
                    file.previewElement.remove();
                    console.log(imagesArray);
                }
            });
        });

        // Category -> Sub Categories
        $(document).ready(function() {
            $('#category').on('change', function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/admin/product-subcategories/' + categoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#sub_category').empty();
                            $('#sub_category').append('<option value="">Select a sub category</option>');
                            $.each(data, function(key, value) {
                                $('#sub_category').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#sub_category').empty();
                    $('#sub_category').append('<option value="">Select a sub category</option>');
                }
            });
        });
    </script>
@endsection
