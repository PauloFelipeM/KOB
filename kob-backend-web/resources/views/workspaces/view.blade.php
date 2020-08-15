@extends('layouts.backend')

@section('title')
{{__('workspace.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <div class="block-header block-header-primary">
                <h3 class="block-title">{{ __('workspace.details') }}</h3>
            </div>
            <div class="block-content block-content-full">
            <div class="form-group row">
                        <div class="col-md-6">
                            <label for="title">{{__('workspace.title')}}</label>
                            <input type="text" class="form-control" readonly id="title" name="title" value="{{ old('title', $workspace->title) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="domain">{{__('workspace.domain')}}</label>
                            <input type="text" class="form-control" readonly id="domain" name="domain" value="{{ old('domain', $workspace->domain) }}">
                        </div>                                              
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="address">{{__('workspace.address')}}</label>
                            <input type="text" class="form-control" readonly id="address" name="address" value="{{ old('address', $workspace->address) }}">
                        </div> 
                        <div class="col-md-6">
                            <label for="id_number">{{__('workspace.id_number')}}</label>
                            <input type="text" class="form-control" readonly id="id_number" name="id_number" value="{{ old('id_number', $workspace->id_number) }}">
                        </div> 
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="contact">{{__('workspace.contact')}}</label>
                            <input type="text" class="form-control" readonly id="contact" name="contact" value="{{ old('contact', $workspace->contact) }}">
                        </div> 
                        <div class="col-md-4">
                            <label for="email">{{__('workspace.phone')}}</label>
                            <input type="text" class="form-control" readonly id="phone" name="phone" value="{{ old('phone', $workspace->phone) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="email">{{__('workspace.email')}}</label>
                            <input type="text" class="form-control" readonly id="email" name="email" value="{{ old('email', $workspace->email) }}">
                        </div> 
                    </div>
                    <hr>
                    <div class="form-group row">                         
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox pt-5">
                                <input type="checkbox" class="custom-control-input" name="disabled" disabled id="disabled" @if($workspace->disabled) checked @endif>
                                <label class="custom-control-label" for="disabled">{{__('workspace.disabled')}}</label>
                            </div>
                        </div>
                    </div>

            </div>

            <div class="block-content block-content-full text-right">
                <a href="{{url('workspaces')}}" class="btn btn-secondary">
                  {{__('default.btn_back')}}
                </a>
            </div>
        </div>
        <!-- END Dynamic Full -->
    <!-- END Page Content -->
@endsection
