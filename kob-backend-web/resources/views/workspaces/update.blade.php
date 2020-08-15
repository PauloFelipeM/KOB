@extends('layouts.backend')

@section('title')
{{__('workspace.page_title') }}
@stop


@section('content')
    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <form action="{{url('/workspaces/store/'.$workspace->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="block-header block-header-primary">
                    <h3 class="block-title">{{ __('workspace.update') }}</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="title">{{__('workspace.title')}}</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $workspace->title) }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="domain">{{__('workspace.domain')}}</label>
                            <input type="text" class="form-control @error('domain') is-invalid @enderror" id="domain" name="domain" value="{{ old('domain', $workspace->domain) }}">
                            @error('domain')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                                              
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="address">{{__('workspace.address')}}</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $workspace->address) }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="col-md-6">
                            <label for="id_number">{{__('workspace.id_number')}}</label>
                            <input type="text" class="form-control @error('id_number') is-invalid @enderror" id="id_number" name="id_number" value="{{ old('id_number', $workspace->id_number) }}">
                            @error('id_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="contact">{{__('workspace.contact')}}</label>
                            <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact', $workspace->contact) }}">
                            @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="col-md-4">
                            <label for="email">{{__('workspace.phone')}}</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $workspace->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="email">{{__('workspace.email')}}</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $workspace->email) }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                    </div>
                    <hr>
                    <div class="form-group row">                         
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox pt-5">
                                <input type="checkbox" class="custom-control-input" name="disabled" id="disabled" @if($workspace->disabled) checked @endif>
                                <label class="custom-control-label" for="disabled">{{__('workspace.disabled')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="block-content block-content-full text-right">
                    <a href="{{url('workspaces')}}" class="btn btn-secondary pull-left">
                      {{__('default.btn_back')}}
                    </a>
                    <button type="submit" class="btn btn-primary">{{ __('default.btn_update') }}</button>
                </div>
            </form>
        </div>
        <!-- END Dynamic Full -->
    <!-- END Page Content -->

@endsection
