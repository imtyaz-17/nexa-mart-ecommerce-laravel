@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Login</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                    <p>{{ session('error')}}</p>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    <p>{{ session('success')}}</p>
                </div>
            @endif
            <div class="login-form">
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <h4 class="modal-title">Login to Your Account</h4>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required="required">
                        @error('email')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" required="required">
                        @error('password')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group small">
                        <a href="{{route('password.request')}}" class="forgot-link">Forgot Password?</a>
                    </div>
                    <input type="submit" class="btn btn-dark btn-block btn-lg" value="Login">
                </form>
                <div class="text-center small">Don't have an account? <a href="{{route('register')}}">Sign up</a></div>
            </div>
        </div>
    </section>
@endsection
