@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Forgot Password</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            @if (session('status'))
                @if (session('status') !== \Illuminate\Support\Facades\Password::RESET_LINK_SENT)
                    <div class="alert alert-success alert-dismissible">
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        <p>{{ session('status') }}</p>
                    </div>
                @else
                    <div class="alert alert-danger alert-dismissible">
                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                        <p>{{ session('status') }}</p>
                    </div>
                @endif
            @endif
            <div class="login-form">
                <form action="{{route('password.email')}}" method="post">
                    @csrf
                    <h4 class="modal-title">Forgot your password?</h4>
                    <p>Just let us know your email address and we will email you a password reset link.</p>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email" required="required">
                        @error('email')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group small">
                        <a href="{{route('login')}}" class="forgot-link"> Login</a>
                    </div>
                    <input type="submit" class="btn btn-dark btn-block btn-lg" value="Submit">
                </form>
            </div>
        </div>
    </section>
@endsection

