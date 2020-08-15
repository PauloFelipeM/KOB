@extends('layouts.auth')

@section('css_before')
<!-- CSS BEFORE START CONTENT -->
@endsection


@section('content')
<!-- Page Content -->
<div class="bg-body-dark">
    <div class="row mx-0 justify-content-center">
        <div class="hero-static col-lg-6 col-xl-4">
            <div class="content content-full overflow-hidden">
                <!-- Header -->
                <div class="py-30 text-center">
                    <a href="#">
                        <img src="{{ asset('media/logo/biglogo.png') }}" style="width:125px;" alt="">
                        <!-- <i class="si si-fire"></i>
                        <span class="font-size-xl text-primary-dark">{{__('default.title_web')}}</span> -->
                    </a>
                    <h1 class="h4 font-w700 mt-30 mb-10">{{__('default.welcome')}}</h1>
                    <!-- <h2 class="h5 font-w400 text-muted mb-0">It’s a great day today!</h2> -->
                </div>
                <!-- END Header -->
                <!-- Sign In Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="block block-themed block-rounded block-shadow">
                        <div class="block-header bg-dark">
                            <h3 class="block-title">{{__('default.please_sign_in')}}</h3>
                            <!-- <div class="block-options">
                                <button type="button" class="btn-block-option">
                                    <i class="si si-wrench"></i>
                                </button>
                            </div> -->
                        </div>
                        <div class="block-content">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="login-username">{{__('auth.email')}}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="login-password">{{__('auth.password')}}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-sm-6 d-sm-flex align-items-center push">
                                    <div class="custom-control custom-checkbox mr-auto ml-0 mb-0">
                                        <input type="checkbox" class="custom-control-input" id="login-remember-me" name="login-remember-me">
                                        <label class="custom-control-label" for="login-remember-me">{{__('auth.remember_me')}}</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-sm-right push">
                                    <button type="submit" class="btn btn-alt-primary">
                                        <i class="si si-login mr-10"></i> {{__('auth.btn_signin')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="block-content bg-body-light">
                            <div class="form-group text-center">
                                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('register') }}">
                                    <i class="fa fa-plus mr-5"></i> {{__('auth.create_acc')}}
                                </a>
                                @if (Route::has('password.request'))
                                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('password.request') }}">
                                    <i class="fa fa-warning mr-5"></i> {{__('auth.forgot_password')}}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END Sign In Form -->
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection