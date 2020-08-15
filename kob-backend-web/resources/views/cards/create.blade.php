@extends('layouts.backend')

@section('title')
{{__('card.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <form action="{{url('/cards/store')}}" method="post">
                @csrf
                <input type="hidden" name="access_id" value="{{ $access_id }}">
                <div class="block-header block-header-primary">
                    <h3 class="block-title">{{ __('card.new') }}</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name">{{__('card.name')}}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="number">{{__('card.number')}}</label>
                            <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number') }}">
                            @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="code">{{__('card.code')}}</label>
                            <input type="number" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}">
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="expiration">{{__('card.expiration')}}</label>
                            <input type="text" class="form-control @error('expiration') is-invalid @enderror" id="expiration" name="expiration" value="{{ old('expiration') }}">
                            @error('expiration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="country_id">{{ __('card.country') }}</label>
                            <select name="country_id" class="form-control @error('country_id') is-invalid @enderror" id="country_id">
                                <option value="">{{__('card.select_country')}}</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="state_id">{{ __('card.state') }}</label>
                            <select name="state_id" class="form-control @error('state_id') is-invalid @enderror" id="state_id">
                                <option value="">{{__('card.select_state')}}</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->state }}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="card_address_postal_code">{{__('card.card_address_postal_code')}}</label>
                            <input type="number" class="form-control @error('card_address_postal_code') is-invalid @enderror" id="card_address_postal_code" 
                                name="card_address_postal_code" value="{{ old('card_address_postal_code') }}">
                            @error('card_address_postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="card_address_city">{{__('card.city')}}</label>
                            <input type="text" class="form-control @error('card_address_city') is-invalid @enderror" id="card_address_city" 
                                name="card_address_city" value="{{ old('card_address_city') }}">
                            @error('card_address_city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="card_address">{{__('card.address')}}</label>
                            <input type="text" class="form-control @error('card_address') is-invalid @enderror" id="card_address" 
                                name="card_address" value="{{ old('card_address') }}">
                            @error('card_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                                
                <div class="block-content block-content-full text-right">
                    <a href="{{url('cards/'.$access_id)}}" class="btn btn-secondary pull-left">
                      {{__('default.btn_back')}}
                    </a>
                    <button type="submit" class="btn btn-primary">{{ __('default.btn_create') }}</button>
                </div>
            </form>
        </div>
        <!-- END Dynamic Full -->
    <!-- END Page Content -->
@endsection
