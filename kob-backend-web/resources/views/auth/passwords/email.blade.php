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
                    <a href="index.html">
                        <img src="{{ asset('media/logo/biglogo.png') }}" style="width:125px;" alt="">
                        <!-- <i class="si si-fire"></i>
                        <span class="font-size-xl text-primary-dark">{{__('default.title_web')}}</span> -->
                    </a>
                    <h1 class="h4 font-w700 mt-30 mb-10">{{__('auth.dont_worry')}}</h1>
                    <h2 class="h5 font-w400 text-muted mb-0">{{__('auth.please_enter_email')}}</h2>
                </div>
                <!-- END Header -->
                <!-- Reminder Form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="block block-themed block-rounded block-shadow">
                        <div class="block-header bg-gd-dark">
                            <h3 class="block-title">{{__('auth.password_recovery')}}</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="reminder-credential">{{__('auth.email')}}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-alt-primary">
                                    <i class="fa fa-asterisk mr-10"></i> {{__('auth.btn_password_recovery')}}
                                </button>
                            </div>
                        </div>
                        <div class="block-content bg-body-light">
                            <div class="form-group text-center">
                                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('login') }}">
                                    <i class="fa fa-user text-muted mr-5"></i> {{__('auth.btn_signin')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END Reminder Form -->
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection