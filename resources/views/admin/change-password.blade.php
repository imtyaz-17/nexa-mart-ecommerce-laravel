@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.process-change-password') }}" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('message')
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" name="current_password" id="current_password"
                                           placeholder="Current Password"
                                           class="form-control @error('current_password') is-invalid @enderror">
                                    @error('current_password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" id="new_password"
                                           placeholder="New Password"
                                           class="form-control @error('new_password') is-invalid @enderror">
                                    @error('new_password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="new_password_confirmation">Confirm Password</label>
                                    <input type="password" name="new_password_confirmation"
                                           id="new_password_confirmation" placeholder="Confirm Password"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{route('admin.dashboard')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
