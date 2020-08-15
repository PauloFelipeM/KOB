@extends('layouts.backend')

@section('title')
{{__('service_type.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <div class="block-header block-header-primary">
                <h3 class="block-title">{{ __('service_type.details') }}</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="form-group row">                    
                    <div class="col-md-9">
                        <label for="title">{{ __('service_type.title') }}</label>
                        <input type="text" readonly class="form-control" name="title" id="title" value="{{ $service_type->title }}">
                    </div>
                    <div class="col-md-3">
                        <img src="{{route('service_type_image',$service_type->storage_filename)}}" style='width:100%;'/>
                    </div>
                </div>

                <hr>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="hourly_amount">{{ __('service_type.hourly_amount') }}</label>
                        <input type="text" readonly class="form-control" name="hourly_amount" id="hourly_amount" value="{{ $service_type->hourly_amount }}">
                    </div>
                    <div class="col-md-6">
                        <label for="min_hourly_rate">{{ __('service_type.min_hourly_rate') }}</label>
                        <input type="number" readonly class="form-control" name="min_hourly_rate" id="min_hourly_rate" value="{{ $service_type->min_hourly_rate }}">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="first_span">{{ __('service_type.first_span') }}</label>
                        <input type="number" readonly class="form-control" name="first_span" id="first_span" value="{{ $service_type->first_span }}">
                    </div>
                    <div class="col-md-6">
                        <label for="first_span_rate">{{ __('service_type.first_span_rate') }}</label>
                        <input type="text" readonly class="form-control" name="first_span_rate" id="first_span_rate" value="{{ $service_type->first_span_rate }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="next_span">{{ __('service_type.next_span') }}</label>
                        <input type="number" readonly class="form-control" name="next_span" id="next_span" value="{{ $service_type->next_span }}">
                    </div>
                    <div class="col-md-6">
                        <label for="next_span_rate">{{ __('service_type.next_span_rate') }}</label>
                        <input type="text" readonly class="form-control" name="next_span_rate" id="next_span_rate" value="{{ $service_type->next_span_rate }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 ml-auto">
                        <label for="remaining_span_rate">{{ __('service_type.remaining_span_rate') }}</label>
                        <input type="text" readonly class="form-control" name="remaining_span_rate" id="remaining_span_rate" value="{{ $service_type->remaining_span_rate }}">
                    </div>

                </div>

            </div>

            <div class="block-content block-content-full text-right">
                <a href="{{url('service_types')}}" class="btn btn-secondary">
                  {{__('default.btn_back')}}
                </a>
            </div>
        </div>
        <!-- END Dynamic Full -->
    <!-- END Page Content -->
@endsection
