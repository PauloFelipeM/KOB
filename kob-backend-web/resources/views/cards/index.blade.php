@extends('layouts.backend')

<!-- @section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection -->

@section('title')
{{__('card.page_title') }}
@stop

@section('content')
<!-- Dynamic Table Full -->
<div class="block">
    <div class="block-header block-header-primary mt-5 row">             
       <div class="col-md-12">
           <div class="row">
                <div class="col-md-6">
                    <h3 class="block-title mb-3">{{ $access->user->name }} @if($access->user->user_square_id) <i class="fa fa-check"></i> @endif</h3>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-6">
      
                    <div class="row">
                        <div class="col-md-6">
                            <form action="/cards" method="GET">
                                @csrf
                                <div class="input-group text-center my-3 my-md-0">
                                    <input type="text" class="form-control" placeholder="{{__('card.search_placeholder')}}" id="page-header-search-input" name="search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2 text-right">
                    <a href="{{url('cards/create/'.$access->id)}}" class="btn btn-primary btn-block btn-create">{{ __('card.btn_create') }}</a>    
                </div>
            </div>
       </div>  
    </div>
    <div class="block-content block-content-full">
        <table class="table table-striped table-vcenter js-dataTable-full table-responsive">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>{{ __('card.name') }}</th>
                    <th>{{ __('card.number') }}</th>
                    <th>{{ __('card.expiration') }}</th>
                    <th>{{ __('card.validate') }}</th>                    
                    <th class="d-none d-sm-table-cell">{{ __('default.created_at') }}</th>
                    <th>{{ __('default.updated_at') }}</th>
                    <th width="1%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cards as $card)
                <tr>
                    <td class="text-center">{{ $card->id }}</td>
                    <td class="font-w600">{{ $card->name }}</td>
                    <td>{{ $card->number }}</td>
                    <td>{{ $card->expiration }}</td>
                    <td>
                        @if(!$card->card_square_id)
                            <a href="{{url('cards/validate/'.$card->id)}}">{{__('card.validate')}}</a>
                        @else
                            {{__('card.validation_successful')}}
                        @endif
                    </td>
                    <td class="d-none d-sm-table-cell">
                        {{\Carbon\Carbon::parse($card->created_at)->format(__('default.format_date'))}}
                    </td>
                    <td>
                        {{\Carbon\Carbon::parse($card->updated_at)->format(__('default.format_date'))}}
                    </td>
                    <td nowrap>
                        <a href="{{url('/cards/update/'.$card->id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:cardDelete('{{ $card->id }}', '{{$card->number}}')" class="btn btn-danger"><i class="fa fa-remove"></i></a>                          
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$cards->appends(Input::except('page'))->links('includes.pagination')}}
    </div>
</div>
<!-- END Dynamic Table Full -->
<!-- END Page Content -->

<script>
  function cardDelete(card_id, card_number){
      console.log(card_id);
      
    swal({
      title: '{{__("messages.delete")}}',
      text: '{{__("messages.confirm_delete")}} '+card_number+'?',
      icon: "warning",
      buttons: true,
      dangerMode: true,
      confirmButtonText: '{{__("messages.confirm")}}',
      cancelButtonText: '{{__("messages.cancel")}}',
    }).then((result) => {
      if (result) {
        window.location = '{{url("cards/delete")}}/'+card_id;        
      }
    })
  }
</script>
@endsection

