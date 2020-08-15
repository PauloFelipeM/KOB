@extends('layouts.backend')

@section('title')
{{__('ticket.page_title') }}
@stop

@section('content')
<!-- Page Content -->
    <!-- Dynamic Full -->
    <div class="block">
        <form action="{{url('/tickets/store/')}}" method="post">
            @csrf
            <input type="hidden" name="access_id" value="{{ $access_id }}">
            <div class="block-header block-header-primary">
                <h3 class="block-title">{{ __('ticket.new') }}</h3>
            </div>
            <div class="block-content block-content-full">

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="service_type">{{__('ticket.select_service_type')}}</label>
                        <select name="service_type" id="service_type" class="form-control">
                            @foreach($services_types as $key => $service_type)
                                <option value="{{ $key }}">{{ $service_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6" id="number_hours_div" style="display:none">
                        <label for="number_hours">{{__('ticket.number_hours')}}</label>
                        <input type="number" class="form-control @error('number_hours') is-invalid @enderror" 
                             max="100" id="number_hours" name="number_hours" 
                            value="{{ old('number_hours', 1) }}" onchange="check_number_hours(this.value)">
                        @error('number_hours')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>   
                </div>

                <div class="form-group row">
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-6">
                                <input type="date" required class="form-control @error('scheduled_date') is-invalid @enderror" id="scheduled_date" name="scheduled_date" value="{{ old('scheduled_date', date('Y-m-d', strtotime('+1 hour'))) }}" >
                                @error('scheduled_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                                
                            </div>
                            <div class="col-6">                
                                <input type="time" required class="form-control @error('scheduled_date_time') is-invalid @enderror" id="scheduled_date_time" name="scheduled_date_time" value="{{ old('scheduled_date_time', date('H:i', strtotime('+1 hour'))) }}" >
                                @error('scheduled_date_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                                
                            </div>
                        </div>                            

                    </div>                    
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="card_id">{{__('ticket.card')}}</label>
                        <select required name="card_id" id="card_id" class="form-control @error('card_id') is-invalid @enderror">
                            <option value="">{{__('ticket.select_card')}}</option>
                            @foreach($cards as $card)
                                <option value="{{ $card->id }}">{{ $card->number }}</option>
                            @endforeach
                        </select>
                        @error('card_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                    <div class="col-md-6">
                        <label for="service_type_id">{{__('ticket.service_type')}}</label>
                        <select name="service_type_id" required id="service_type_id" class="form-control @error('service_type_id') is-invalid @enderror">
                            <option value="">{{__('ticket.service_serviceType')}}</option>
                            @foreach($service_types as $service_type)
                                <option value="{{ $service_type->id }}">{{ $service_type->title }}</option>
                            @endforeach
                        </select>
                        @error('service_type_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="origin_address">{{__('ticket.origin_address')}}</label>
                        <input type="text" required class="form-control @error('origin_address') is-invalid @enderror" 
                        placeholder="{{__('ticket.set_place_pickup')}}" id="origin_address" name="origin_address" value="">
                        @error('origin_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">                        
                    <div class="col-md-12">                        
                        <div class="map" id="map" style="background:#ccc; height:300px; "></div>
                    </div>                       
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="amount">{{__('ticket.amount')}}</label>
                        <input type="number" min="0" step="0.01" class="form-control" id="amount" value="{{ old('amount') }}" name="amount">
                    </div>                 
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox mb-3" id="checkbox_additional_commments_div">
                            <input type="checkbox" class="custom-control-input" name="checkbox_additional_commments" id="checkbox_additional_commments">
                            <label class="custom-control-label" for="checkbox_additional_commments">{{__('ticket.checkbox_active_comments')}}</label>
                        </div>
                        <div class="" id="additional_commments_div" style="display:none;">
                            <label for="additional_commments">{{__('ticket.additional_commments')}}</label>
                            <textarea class="form-control" id="additional_commments" name="additional_commments">{{ old('additional_commments') }}</textarea>
                        </div>
                    </div>
                </div>
        
                <div class="block-content block-content-full text-right">
                    <a href="{{url('users')}}" class="btn btn-secondary  pull-left">
                      {{__('default.btn_back')}}
                    </a>
                    <button type="submit" class="btn btn-primary">{{ __('default.btn_create') }}</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END Dynamic Full -->
<!-- END Page Content -->

<style>
      #map {
        height: 450px;
      }
</style>

<script src="{{ asset('js/tickets.js') }}"></script>


<script>
    var distance = null;

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          mapTypeControl: false,
          center: {lat: 38.9695085, lng: -102.8150356},
          zoom: 6.49
        });

        new AutocompleteDirectionsHandler(map);
      }

            /**
       * @constructor
       */
      function AutocompleteDirectionsHandler(map) {
        this.map = map;
        this.originPlaceId = null;
        this.destinationPlaceId = null;
        this.travelMode = 'DRIVING';
        this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer;
        this.directionsDisplay.setMap(map);

        var originInput = document.getElementById('origin_address');
        var destinationInput = document.getElementById('destination_address');

        var originAutocomplete = new google.maps.places.Autocomplete(originInput);
        // Specify just the place data fields that you need.
        originAutocomplete.setFields(['place_id']);

        var destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);
        // Specify just the place data fields that you need.
        destinationAutocomplete.setFields(['place_id']);

        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

      }

      AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);

        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();

          if (!place.place_id) {
            window.alert('Please select an option from the dropdown list.');
            return;
          }
          if (mode === 'ORIG') {
            me.originPlaceId = place.place_id;
          } else {
            me.destinationPlaceId = place.place_id;
          }
          me.route();
        });
      };

      AutocompleteDirectionsHandler.prototype.route = function() {
        if (!this.originPlaceId || !this.destinationPlaceId) {
          return;
        }
        var me = this;

        this.directionsService.route(
            {
              origin: {'placeId': this.originPlaceId},
              destination: {'placeId': this.destinationPlaceId},
              travelMode: this.travelMode,
              unitSystem: google.maps.UnitSystem.IMPERIAL,
            },
            function(response, status) {
              if (status === 'OK') {
                me.directionsDisplay.setDirections(response);                
                distance = response.routes[0].legs[0].distance.value;

                calculate();
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            });
      };

      function calculate(){

        service_type = $('#service_type').val();   
        service_type_id = $('#service_type_id').val();     
        minutes = null;
        miles = null;

        if(service_type == 1){            
            miles = distance / 1609.344;
            console.log('distance: '+distance);
            console.log('miles: '+miles);            
            //miles = (distance / 1000) * 0.621371;
        }else if(service_type == 2){
            minutes = $('#number_hours').val() * 60;
            console.log('minutes: '+minutes)
        }

        if(service_type_id && (miles || minutes)){
            console.log('Calculating rate...');
            $.ajax({
                url: "{{url('tickets/calculate')}}",
                type: 'GET',
                data: {service_type_id: service_type_id, service_type: service_type, minutes: minutes, miles: miles},
                success: function(response){
                    $('#amount').val(response);
                    console.log(response);
                }
            });
        }
      }

      $('#number_hours, #service_type_id, #service_type').on('change',function(){
          calculate();
      })


</script>



@endsection