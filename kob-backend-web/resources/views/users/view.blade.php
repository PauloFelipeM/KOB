@extends('layouts.backend')

@section('title')
{{__('user.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <div class="block-header block-header-primary">
                <h3 class="block-title">{{ __('user.details') }} - {{$user->email}}</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">{{__('user.name')}}</label>
                        <input type="text" class="form-control" readonly id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="col-md-6">
                        <label for="name">{{__('user.role')}}</label>
                        <select name="role" id="role" disabled class="form-control">
                            <option value="">{{__('user.select_role')}}</option>
                            @foreach($roles as $key => $role)
                                <option value="{{ $key }}" {{ ( $key == $user->role) ? 'selected' : '' }} > {{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="email">{{__('user.email')}}</label>
                        <input type="email" class="form-control" readonly id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number">{{__('user.phone_number')}}</label>
                        <input type="phone_number" class="form-control" readonly id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="cards h4">{{__('card.page_title')}} @if($user->user_square_id) <i class="fa fa-check"></i> @endif                         <a href="{{url('/cards/'.$user->id)}}" class="btn btn-secondary pull-right">{{__('card.manage')}}</a></div>

                    

                        <div class="mb-2">
                            @foreach($user->cards as $card)
                                <div>
                                <b>{{$card->number}}</b> - {{$card->name}}
                                @if(!$card->card_square_id) - <a href="{{url('cards/validate/'.$card->id)}}">{{__('card.validate')}}</a> @endif
                                </div>
                            @endforeach
                        </div>

                    </div>                      
                </div>                
            </div>                
        
                            
            <div class="block-content block-content-full text-right">
                <a href="{{url('users')}}" class="btn btn-secondary">
                  {{__('default.btn_back')}}
                </a>                    
            </div>
        </div>
        <!-- END Dynamic Full -->
    <!-- END Page Content -->
@endsection
