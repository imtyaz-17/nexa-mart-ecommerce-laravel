@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('profile.sidebar')
                </div>
                <div class="col-md-9">
                    @include('message')
                    <div class="shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    <div class="shadow sm:rounded-lg mt-3">
                        <div class="max-w-xl">
                            @include('profile.partials.update-address-form')
                        </div>
                    </div>
                    <div class="p-4 bg-white shadow sm:rounded-lg mt-3">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
