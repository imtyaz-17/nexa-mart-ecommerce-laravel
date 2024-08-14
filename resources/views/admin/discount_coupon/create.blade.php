@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Coupon Code</h1>
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
            <form action="{{route('admin.coupons.store')}}" method="POST" id="coupon-form">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Coupon Code</label>
                                    <input type="text" name="code" id="code" value="{{old('code')}}"
                                           class="form-control @error('code') is-invalid @enderror"
                                           placeholder="Coupon Code">
                                    @error('code')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Coupon Name</label>
                                    <input type="text" name="name" id="name" value="{{old('name')}}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Coupon Code Name">
                                    @error('name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              placeholder="Coupon Description">
                                        {{old('description')}}
                                    </textarea>
                                    @error('description')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_uses">Max Uses</label>
                                    <input type="number" name="max_uses" id="max_uses" value="{{old('max_uses')}}"
                                           class="form-control @error('max_uses') is-invalid @enderror"
                                           placeholder="Max Uses">
                                    @error('max_uses')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_uses_user">Max Uses User</label>
                                    <input type="number" name="max_uses_user" id="max_uses_user"
                                           value="{{old('max_uses_user')}}"
                                           class="form-control @error('max_uses_user') is-invalid @enderror"
                                           placeholder="Max Uses User">
                                    @error('max_uses_user')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type">Discount Type</label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percent</option>
                                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    </select>
                                    @error('type')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discount">Discount Amount</label>
                                    <input type="number" name="discount" id="discount" value="{{old('discount')}}"
                                           class="form-control @error('discount') is-invalid @enderror"
                                           placeholder="Discount Amount">
                                    @error('discount')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="min_purchased">Min Purchased Amount</label>
                                    <input type="number" name="min_purchased" id="min_purchased"
                                           value="{{old('min_purchased')}}"
                                           class="form-control @error('min_purchased') is-invalid @enderror"
                                           placeholder="Min Purchased Amount">
                                    @error('min_purchased')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Block</option>
                                    </select>
                                    @error('status')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="starts_at">Starts At</label>
                                    <input type="text" name="starts_at" id="starts_at" value="{{old('starts_at')}}"
                                           class="form-control @error('starts_at') is-invalid @enderror"
                                           placeholder="Coupon Start Date">
                                    @error('starts_at')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ends_at">Ends At</label>
                                    <input type="text" name="ends_at" id="ends_at" value="{{old('ends_at')}}"
                                           class="form-control @error('ends_at') is-invalid @enderror"
                                           placeholder="Coupon Expires Date">
                                    @error('ends_at')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{route('admin.coupons.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customJs')
    <script type="text/javascript">
        // DateTime Picker
        $(document).ready(function () {
            $('#starts_at, #ends_at').datetimepicker({
                format: 'Y-m-d H:i:s',
                // Additional options can go here
            });
        });
    </script>
@endsection
