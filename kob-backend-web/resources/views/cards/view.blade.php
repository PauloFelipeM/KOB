@extends('layouts.backend')

@section('title')
{{__('card.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <div class="block-header block-header-primary">
                <h3 class="block-title">{{ __('card.details') }}</h3>
            </div>
            <div class="block-content block-content-full">
               <div class="row">
                    <div class="col-md-6">
                        <label for="name">{{__('card.name')}}</label>
                        <input type="text" class="form-control" readonly id="name" name="name" value="{{ $card->name }}">
                    </div>
                    <div class="col-md-6">
                        <label for="number">{{__('cartype.number')}}</label>
                        <input type="number" class="form-control" readonly id="number" name="number" value="{{ $card->number }}">
                    </div>
               </div>
            </div>

            <div class="block-content block-content-full text-right">
                <a href="{{url('cards')}}" class="btn btn-secondary">
                  {{__('default.btn_back')}}
                </a>
            </div>
        </div>
        <!-- END Dynamic Full -->
    <!-- END Page Content -->
@endsection
