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
                    <h1 class="h4 font-w700 mt-30 mb-10">{{__('auth.new_acc')}}</h1>
                    <h2 class="h5 font-w400 text-muted mb-0">{{__('auth.excited_message')}}</h2>
                </div>
                <!-- END Header -->
                <!-- Sign In Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="block block-themed block-rounded block-shadow">
                        <div class="block-header bg-dark">
                            <h3 class="block-title">{{__('auth.add_details')}}</h3>                                            
                        </div>
                        <div class="block-content">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="name">{{__('auth.username')}}</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="email">{{__('auth.email')}}</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="password">{{__('auth.password')}}</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="password-confirm">{{__('auth.password_confirmation')}}</label>
                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row mb-0">                                                
                                <div class="col-sm-12 text-sm-right push">
                                    <button type="submit" class="btn btn-alt-success">
                                        <i class="fa fa-plus mr-10"></i> {{__('auth.btn_create_acc')}}
                                    </button>
                                </div>
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
                <!-- END Sign In Form -->
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection