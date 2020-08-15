@extends('layouts.backend')

<!-- @section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection -->

@section('title')
{{__('service_type.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">{{ __('service_type.page_title') }}</h2>
        </div> -->

        <!-- Info -->
        <!-- <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted">
                            This page showcases how easily you can add a plugin’s JS/CSS assets and init it using custom JS code.
                        </p>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- END Info -->

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-primary mt-5 row">             
               <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 my-3 my-md-0">
                            <form action="/service_types" method="GET">
                                @csrf
                                <div class="input-group text-center">
                                    <input type="text" class="form-control" placeholder="{{__('service_type.search_placeholder')}}" id="page-header-search-input" name="search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-2 text-right">
                            <a href="{{url('/service_types/create')}}" class="btn btn-primary btn-block btn-create">{{ __('service_type.btn_create') }}</a>    
                        </div>
                    </div>
               </div>  
            </div>
            <div class="block-content block-content-full">
                <table class="table table-striped table-vcenter js-dataTable-full table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>{{ __('service_type.title') }}</th>
                            <th>{{__('service_type.hourly_amount')}}</th>
                            <th>{{__('service_type.min_hourly_rate')}}</th>
                            <th>{{__('service_type.first_span')}}</th>
                            <th>{{__('service_type.next_span')}}</th>
                            <th>{{__('service_type.remaining_span_rate')}}</th>                                                                                    
                            
                            <!--
                            <th class="d-none d-sm-table-cell">{{ __('default.created_at') }}</th>
                            <th>{{ __('default.updated_at') }}</th>
                            -->
                            <th width="1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($service_types as $service_type)
                        <tr>
                            <td class="text-center">{{ $service_type->id }}</td>
                            <td class="font-w600">
                                <a href="{{url('/service_types/view/'.$service_type->id)}}">{{ $service_type->title }}</a>
                            </td>
                            <td>USD {{ $service_type->hourly_amount }}</td>
                            <td>USD {{ $service_type->min_hourly_rate }}</td>

                            <td>
                                {{ $service_type->first_span }} mi.<br>
                                USD {{ number_format($service_type->first_span_rate, 2) }}
                            </td>
                            <td>
                                {{ $service_type->next_span }} mi.<br>
                                USD {{ number_format($service_type->next_span_rate, 2) }}
                            </td>
                            <td>
                                USD {{ number_format($service_type->remaining_span_rate, 2) }}
                            </td>                                                                                    

                            <td nowrap>
                                <a href="{{url('/service_types/update/'.$service_type->id)}}" class="btn btn-secondary"
                                    data-toggle="tooltip" data-placement="top" title="{{__('service_type.update')}}"><i class="fa fa-edit"></i></a>
                                <a href="javascript:service_typeDelete('{{$service_type->id}}', '{{$service_type->title}}')" class="btn btn-danger"
                                    data-toggle="tooltip" data-placement="top" title="{{__('default.btn_delete')}}"><i class="fa fa-remove"></i></a>                          
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$service_types->appends(Input::except('page'))->links('includes.pagination')}}
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    <!-- END Page Content -->

<script>
  function service_typeDelete(service_type_id, service_type_title){
    swal({
      title: '{{__("messages.delete")}}',
      text: '{{__("messages.confirm_delete")}} '+service_type_title+'?',
      icon: "warning",
      buttons: true,
      dangerMode: true,
      confirmButtonText: '{{__("messages.confirm")}}',
      cancelButtonText: '{{__("messages.cancel")}}',
    }).then((result) => {
      if (result) {
        window.location = '{{url("service_types/delete")}}/'+service_type_id;
      }
    })
  }
</script>
@endsection

