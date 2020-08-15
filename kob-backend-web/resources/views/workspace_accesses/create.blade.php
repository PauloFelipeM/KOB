@extends('layouts.backend')

@section('title')
{{__('access.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <form action="{{url('/workspace_accesses/store')}}" method="post">
                @csrf
                <div class="block-header block-header-primary">
                    <h3 class="block-title">{{ __('access.new') }}</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="email">{{__('access.email')}}</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">  
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox pt-5">
                                <input type="checkbox" class="custom-control-input" name="is_admin" id="is_admin">
                                <label class="custom-control-label" for="is_admin">{{__('access.admin_access')}}</label>
                            </div>
                        </div>                       
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox pt-5">
                                <input type="checkbox" class="custom-control-input" name="is_manager" id="is_manager">
                                <label class="custom-control-label" for="is_manager">{{__('access.manager_access')}}</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox pt-5">
                                <input type="checkbox" class="custom-control-input" name="is_employee" id="is_employee">
                                <label class="custom-control-label" for="is_employee">{{__('access.employee_access')}}</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox pt-5">
                                <input type="checkbox" class="custom-control-input" name="is_blocked" id="is_blocked">
                                <label class="custom-control-label" for="is_blocked">{{__('access.blocked_access')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                                
                <div class="block-content block-content-full text-right">
                    <a href="{{url('workspace_accesses')}}" class="btn btn-secondary pull-left">
                      {{__('default.btn_back')}}
                    </a>
                    <button type="submit" class="btn btn-primary">{{ __('default.btn_create') }}</button>
                </div>
            </form>
        </div>
        <!-- END Dynamic Full -->
    <!-- END Page Content -->
@endsection
