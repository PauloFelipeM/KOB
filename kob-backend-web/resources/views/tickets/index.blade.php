@extends('layouts.backend')

<!-- @section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection -->

@section('title')
{{__('ticket.page_title') }}
@stop

@section('content')
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-primary mt-5 row">             
               <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 my-3 my-md-0">
                            <form action="/tickets" method="GET">
                                @csrf
                                <div class="input-group text-center">
                                    <input type="text" class="form-control" placeholder="{{__('ticket.search_placeholder')}}" id="page-header-search-input" name="search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- <div class="col-md-5"></div>
                        <div class="col-md-2 text-right">
                            <a href="{{url('/tickets/create')}}" class="btn btn-primary btn-block btn-create">{{ __('ticket.btn_create') }}</a>    
                        </div> -->
                    </div>
               </div>  
            </div>
            <div class="block-content block-content-full">
                <table class="table table-striped table-vcenter js-dataTable-full table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 30px;">#</th>
                            <th>{{ __('ticket.scheduled_date') }}</th>
                            <th>{{ __('ticket.user') }}</th>
                            <th>{{ __('ticket.service_type') }}</th>
                            <th>{{ __('ticket.type') }}</th>
                            <th>{{ __('ticket.employee') }}</th>
                            <th>{{__('ticket.status')}}</th>
                            <th>{{__('ticket.amount')}}</th>
                            <th width="1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr>
                            <td class="text-center">{{ $ticket->id }}</td>
                            <td class="d-none d-sm-table-cell">
                                {{\Carbon\Carbon::parse($ticket->scheduled_date)->format(__('ticket.format_date'))}}
                            </td>
                            <td >
                                {{ $ticket->access->user->name }}
                            </td>                            
                            <td >
                                {{ __('ticket.service_type_'.$ticket->service_type) }}
                                @if($ticket->origin_address)
                                    <div class="small">
                                        <i class="fa fa-map-marker"></i> 
                                        {{ $ticket->origin_address }}
                                    </div>
                                @endif
                                @if($ticket->number_hours)
                                    <div class="small">
                                        <i class="fa fa-clock"></i> 
                                        {{ $ticket->number_hours }}h
                                    </div>
                                @endif                                
                            </td>                            
                            <td class="">
                                <div>{{ $ticket->serviceType->title }}</div>
                            </td>                          
                            <td>
                                @if($ticket->employee_id)
                                    {{ $ticket->employee->user->name }}
                                @else
                                    <em class="small">{{__('ticket.pending')}}</em>
                                @endif
                            </td>           
                            <td>
                                @if(!$ticket->status)
                                    <a href="{{url('/tickets/start/'.$ticket->id)}}" class="btn btn-secondary">{{__('ticket.start_running')}}</a>
                                @elseif($ticket->status == __('ticket.started'))
                                    <a href="{{url('/tickets/finish/'.$ticket->id)}}" class="btn btn-success">{{__('ticket.finish_running')}}</a>
                                @else
                                    {{__('ticket.finished')}}<br>
                                    <small>{{ $ticket->status }}</small>
                                @endif
                            </td>
                            <td>
                                @if(!$ticket->amount)
                                    <a href="{{url('/tickets/update/'.$ticket->id.'/'.$ticket->access_id)}}">{{__('ticket.set_amount')}}</a>
                                @else
                                    {{__('ticket.amount')}}<br>
                                    <small>{{ $ticket->amount }}</small>
                                    <small><br>Tip:{{ $ticket->tip_amount }}</small>
                                    <small><br><b>Total: {{ $ticket->amount + $ticket->tip_amount }}</b></small>
                                    <div>{{$ticket->payment_status}}</div>
                                    @if(!$ticket->payment_done)
                                    <div>
                                        <a href="{{url('tickets/charge/'.$ticket->id)}}">{{__('ticket.charge')}}</a>
                                    </div>
                                    @endif                                                                        
                                @endif
                            </td>                            
                            <td nowrap>
                                @if(!$ticket->payment_done)
                                <a href="{{url('/tickets/update/'.$ticket->id.'/'.$ticket->access_id)}}" class="btn btn-secondary"
                                    data-toggle="tooltip" data-placement="top" title="{{__('ticket.update')}}"><i class="fa fa-edit"></i></a>
                                <a href="javascript:ticketDelete('{{$ticket->id}}')" class="btn btn-danger"
                                    data-toggle="tooltip" data-placement="top" title="{{__('default.btn_delete')}}"><i class="fa fa-remove"></i></a>     
                                @endif   
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$tickets->appends(Input::except('page'))->links('includes.pagination')}}
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    <!-- END Page Content -->

<script>
  function ticketDelete(ticket_id){
    swal({
      title: '{{__("messages.delete")}}',
      text: '{{__("messages.confirm_delete")}}? #'+ticket_id,
      icon: "warning",
      buttons: true,
      dangerMode: true,
      confirmButtonText: '{{__("messages.confirm")}}',
      cancelButtonText: '{{__("messages.cancel")}}',
    }).then((result) => {
      if (result) {
        window.location = '{{url("tickets/delete")}}/'+ticket_id;
      }
    })
  }
</script>
@endsection

