@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Brand</h1>
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
            <form action="{{route('admin.brands.update', $brand->id)}}" method="POST" enctype="multipart/form-data" id="brand-form">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{$brand->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                    @error('name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" value="{{$brand->slug}}" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug">
                                    @error('slug')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="hidden" id="image_name" name="image">
                                    <label for="image">Image</label>
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                </div>
                                @if(!empty($brand->image))
                                    <div>
                                        <img src="{{asset('uploads/brandImage/thumb/'.$brand->image)}}" alt="" width="200" height="100">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option  value="1" {{ $brand->status == true ? 'selected' : '' }}>Active</option>
                                        <option  value="0"  {{ $brand->status == false ? 'selected' : '' }}>Block</option>
                                    </select>
                                    @error('status')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('admin.categories.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>

        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- DropZone -->
    <script src="{{asset('admin-assets/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <script type="text/javascript">
        {{--     Dynamic Slug Generation--}}
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');

            titleInput.addEventListener('input', function() {
                let slug = titleInput.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
                slugInput.value = slug;
            });
        });
        // Dropzone File Uploader
        Dropzone.autoDiscover = false;
        document.addEventListener('DOMContentLoaded', function() {
            const dropzone = new Dropzone("#image", {
                init: function() {
                    this.on('addedfile', function(file) {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }
                    });
                },
                url: "{{ route('image.upload', ['folder' => 'brandImage']) }}",
                maxFiles: 1,
                paramName: 'image',
                addRemoveLinks: true,
                acceptedFiles: "image/jpeg,image/png,image/gif",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }, success: function(file, response){
                    $("#image_name").val(response.image);
                    //console.log(response)
                }
            });
        });
    </script>
@endsection
