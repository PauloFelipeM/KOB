@extends('layouts.backend')

@section('title')
{{__('access.page_title') }}
@stop


@section('content')
    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <form action="{{url('/accesses/store/'.$access->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="block-header block-header-primary">
                    <h3 class="block-title">{{ __('access.update') }}</h3>
                </div>
                <div class="block-content block-content-full">                    
                    <div class="form-group row">  
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox pt-5">
                                <input type="checkbox" class="custom-control-input" name="is_admin" id="is_admin" @if($access->is_admin) checked @endif>
                                <label class="custom-control-label" for="is_admin">{{__('access.admin_access')}}</label>
                            </div>
                        </div>                       
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox pt-5">
                                <input type="checkbox" class="custom-control-input" name="is_manager" id="is_manager" @if($access->is_manager) checked @endif>
                                <label class="custom-control-label" for="is_manager">{{__('access.manager_access')}}</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox pt-5">
                                <input type="checkbox" class="custom-control-input" name="is_employee" id="is_employee" @if($access->is_employee) checked @endif>
                                <label class="custom-control-label" for="is_employee">{{__('access.employee_access')}}</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox pt-5">
                                <input type="checkbox" class="custom-control-input" name="is_blocked" id="is_blocked" @if($access->is_blocked) checked @endif>
                                <label class="custom-control-label" for="is_blocked">{{__('access.blocked_access')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-right">
                    <a href="{{url('accesses/'.$access->workspace_id)}}" class="btn btn-secondary pull-left">
                      {{__('default.btn_back')}}
                    </a>
                    <button type="submit" class="btn btn-primary">{{ __('default.btn_update') }}</button>
                </div>
            </form>
        </div>
        <!-- END Dynamic Full -->
    <!-- END Page Content -->

@endsection
