@extends('front.layouts.app')

@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('profile') }}">My Account</a></li>
                        <li class="breadcrumb-item">Settings</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-11">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-3">
                        @include('profile.sidebar')
                    </div>
                    <div class="col-md-9">
                        @include('message')
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">Change Password</h2>
                            </div>
                            <form method="POST" action="{{ route('password.update') }}" class="p-2 mt-6 space-y-6">
                                @csrf
                                @method('PUT')
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="current_password">Current Password</label>
                                            <input type="password" name="current_password" id="current_password" placeholder="Current Password" class="form-control @error('current_password') is-invalid @enderror">
                                            @error('current_password')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="new_password">New Password</label>
                                            <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control @error('new_password') is-invalid @enderror">
                                            @error('new_password')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="new_password_confirmation">Confirm Password</label>
                                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm Password" class="form-control">
                                        </div>
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-dark">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
