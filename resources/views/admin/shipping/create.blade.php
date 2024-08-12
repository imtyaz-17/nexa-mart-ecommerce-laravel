@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipping Management</h1>
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
            @include('message')
            <form action="{{route('admin.shipping.store')}}" method="POST" id="shipping-form">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Country</label>
                                    <select name="country" id="country"
                                            class="form-control @error('country') is-invalid @enderror">
                                        <option value="">Select a Country</option>
                                        @if($countries->isNotEmpty())
                                            )
                                            @foreach($countries as $country)
                                                <option
                                                    value="{{$country->id}}"  {{ old('country')==$country->id ? 'selected' : '' }}>
                                                    {{$country->name}}
                                                </option>
                                            @endforeach
{{--                                            <option value="999">Rest of the world.</option>--}}
                                        @endif
                                    </select>
                                    @error('country')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount">Shipping Charge</label>
                                    <input type="text" name="amount" id="amount" value="{{old('amount')}}" class="form-control @error('amount') is-invalid @enderror" placeholder="Amount">
                                    @error('amount')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{route('admin.shipping.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>

        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection

@section('customJs')
    <script type="text/javascript">
    </script>
@endsection

