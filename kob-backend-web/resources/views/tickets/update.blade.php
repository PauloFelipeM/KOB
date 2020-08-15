@extends('layouts.backend')

@section('title')
{{__('ticket.page_title') }}
@stop

@section('content')
<!-- Page Content -->
    <!-- Dynamic Full -->
    <div class="block">
        <form action="{{url('/tickets/store/'.$ticket->id)}}" method="post">
            @csrf
            <input type="hidden" name="access_id" value="{{ $access_id }}">
            <div class="block-header block-header-primary">
                <h3 class="block-title">{{ __('ticket.update') }}</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="form-group row">
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-6">
                                <label for="scheduled_date">{{__('ticket.scheduled_date')}}</label>
                                <input type="date" class="form-control @error('scheduled_date') is-invalid @enderror" id="scheduled_date" name="scheduled_date" 
                                        value="{{ old('scheduled_date', date('Y-m-d', strtotime($ticket->scheduled_date))) }}">
                                @error('scheduled_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">

                                <label for="scheduled_date_time">{{__('ticket.scheduled_date_time')}}</label>
                                <input type="time" class="form-control @error('scheduled_date_time') is-invalid @enderror" id="scheduled_date_time" name="scheduled_date_time" 
                                        value="{{ old('scheduled_date_time', date('H:i', strtotime($ticket->scheduled_date))) }}">
                                @error('scheduled_date_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="card_id">{{__('ticket.card')}}</label>
                        <select name="card_id" id="card_id" class="form-control">
                            <option value="">{{__('ticket.select_card')}}</option>
                            @foreach($cards as $card)
                                <option value="{{ $card->id }}" {{ ( $card->id == $ticket->card_id) ? 'selected' : '' }}>{{ $card->number }}</option>
                            @endforeach
                        </select>
                        @error('card_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="service_type_id">{{__('ticket.service_type')}}</label>
                        <select name="service_type_id" id="service_type_id" class="form-control " disabled readonly> 
                            <option value="">{{$ticket->serviceType->title}}</option>
                        </select>
                        @error('service_type_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="employee_id">{{__('ticket.employee')}}</label>
                        <select name="employee_id" id="employee_id" class="form-control">
                            <option value="">{{__('ticket.select_employee')}}</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ ( $employee->id == $ticket->employee_id) ? 'selected' : '' }}>{{ $employee->user->name }}</option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="amount">{{__('ticket.amount')}}</label>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" step="0.01" name="amount" value="{{ old('amount', $ticket->amount) }}">
                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tip_amount">{{__('ticket.tip_amount')}}</label>
                        <input type="number" min="0" class="form-control @error('tip_amount') is-invalid @enderror" step="0.01" id="tip_amount" name="tip_amount" 
                            value="{{ old('tip_amount', $ticket->tip_amount) }}">
                        @error('tip_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <?php 
                    $transit_start = $ticket->transit_start? date('Y-m-d\TH:i', strtotime($ticket->transit_start)) : null;
                    $transit_finish = $ticket->transit_finish? date('Y-m-d\TH:i', strtotime($ticket->transit_finish)) : null;
                ?>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="transit_start">{{__('ticket.transit_start')}}</label>
                        <input type="datetime-local" class="form-control @error('transit_start') is-invalid @enderror" id="transit_start" name="transit_start" 
                            value="{{ old('transit_start', $transit_start ) }}">
                        @error('transit_start')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="transit_finish">{{__('ticket.transit_finish')}}</label>
                        <input type="datetime-local" class="form-control @error('transit_finish') is-invalid @enderror" id="transit_finish" name="transit_finish" 
                            value="{{ old('transit_finish', $transit_finish) }}">
                        @error('transit_finish')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="origin_address">{{__('ticket.origin_address')}}</label>
                        <input disabled readonly type="text" class="form-control @error('origin_address') is-invalid @enderror" id="origin_address"  
                            value="{{ old('origin_address', $ticket->origin_address) }}">
                        @error('origin_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="additional_commments">{{__('ticket.additional_commments')}}</label>
                        <textarea class="form-control" id="additional_commments" name="additional_commments">{{ old('additional_commments', $ticket->additional_commments) }}</textarea>
                    </div>
                </div>
               
            </div>
                            
            <div class="block-content block-content-full text-right">
                <a href="{{url('tickets')}}" class="btn btn-secondary pull-left">
                  {{__('default.btn_back')}}
                </a>
                <button type="submit" class="btn btn-primary">{{ __('default.btn_update') }}</button>
            </div>
        </form>
    </div>
    <!-- END Dynamic Full -->
<!-- END Page Content -->
@endsection
