@extends('layouts.backend')

@section('title')
{{__('service_type.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <form action="{{url('/service_types/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="block-header block-header-primary">
                    <h3 class="block-title">{{ __('service_type.new') }}</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="title">{{__('service_type.title')}}</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="file">{{__('service_type.select_image')}}</label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                                                
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="hourly_amount">{{__('service_type.hourly_amount')}}</label>
                            <input type="number" min="0.01" step="0.01" class="form-control @error('hourly_amount') is-invalid @enderror" id="hourly_amount" 
                                name="hourly_amount" value="{{ old('hourly_amount', '0.01') }}">
                            @error('hourly_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="min_hourly_rate">{{__('service_type.min_hourly_rate')}}</label>
                            <input type="number" min="0.01" step="0.01" class="form-control @error('min_hourly_rate') is-invalid @enderror" id="min_hourly_rate" 
                                name="min_hourly_rate" value="{{ old('min_hourly_rate', '0.01') }}">
                            @error('min_hourly_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="first_span">{{__('service_type.first_span')}}</label>
                            <input type="number" min="0.1" step="0.1" class="form-control @error('first_span') is-invalid @enderror" id="first_span" 
                                name="first_span" value="{{ old('first_span', '0.1') }}">
                            @error('first_span')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="first_span_rate">{{__('service_type.first_span_rate')}}</label>
                            <input type="number" min="0.01" step="0.01" class="form-control @error('first_span_rate') is-invalid @enderror" id="first_span_rate" 
                                name="first_span_rate" value="{{ old('first_span_rate', '0.01') }}">
                            @error('first_span_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="next_span">{{__('service_type.next_span')}}</label>
                            <input type="number" min="0.1" step="0.1" class="form-control @error('next_span') is-invalid @enderror" id="next_span" 
                                name="next_span" value="{{ old('next_span', '0.1') }}">
                            @error('next_span')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="next_span_rate">{{__('service_type.next_span_rate')}}</label>
                            <input type="number" min="0.01"  step="0.01" class="form-control @error('next_span_rate') is-invalid @enderror" id="next_span_rate" 
                                name="next_span_rate" value="{{ old('next_span_rate', '0.01') }}">
                            @error('next_span_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 ml-auto">
                            <label for="remaining_span_rate">{{__('service_type.remaining_span_rate')}}</label>
                            <input type="number" min="0.01" step="0.01" class="form-control @error('remaining_span_rate') is-invalid @enderror" id="remaining_span_rate" 
                                name="remaining_span_rate" value="{{ old('remaining_span_rate', '0.01') }}">
                            @error('remaining_span_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>
                                
                <div class="block-content block-content-full text-right">
                    <a href="{{url('service_types')}}" class="btn btn-secondary pull-left">
                      {{__('default.btn_back')}}
                    </a>
                    <button type="submit" class="btn btn-primary">{{ __('default.btn_create') }}</button>
                </div>
            </form>
        </div>
        <!-- END Dynamic Full -->
    <!-- END Page Content -->


@endsection
