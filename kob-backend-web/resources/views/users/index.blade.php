@extends('layouts.backend')

<!-- @section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection -->

@section('title')
{{__('user.page_title') }}
@stop

@section('content')
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-primary mt-5 row">             
               <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-4 my-3 my-md-0">
                            <form action="/users" method="GET">
                                @csrf
                                <div class="input-group text-center">
                                    <input type="text" class="form-control" placeholder="{{__('user.search_placeholder')}}" id="page-header-search-input" name="search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5"></div>
                        <!-- <div class="col-md-2 text-right">
                            <a href="{{url('/users/create')}}" class="btn btn-primary btn-block btn-create">{{ __('user.btn_create') }}</a>    
                        </div> -->
                    </div>
               </div>  
            </div>
            <div class="block-content block-content-full">
                <table class="table table-striped table-vcenter js-dataTable-full table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>{{ __('user.name') }}</th>
                            <th>{{ __('user.email') }}</th>
                            <th>{{__('user.phone_number')}}</th>                                                      
                            <th class="d-none d-sm-table-cell">{{ __('default.created_at') }}</th>
                            <th width="1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td class="font-w600">
                                <a href="{{url('/users/view/'.$user->id)}}">{{ $user->name }}</a>
                                <div class="small">
                                @if($user->role == 'user') {{ __('user.user') }}
                                @elseif($user->role == 'admin') {{__('user.admin')}}@endif
                                @if($user->user_square_id) <i class="fa fa-check"></i> @endif
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->phone_number)
                                    {{ $user->phone_number }}
                                @endif
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{\Carbon\Carbon::parse($user->created_at)->format(__('default.format_date'))}}
                            </td>
                            <td nowrap>
                                <a href="{{url('/users/update/'.$user->id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                                
                                <a href="javascript:userDelete('{{$user->id}}', '{{$user->name}}')" class="btn btn-danger"><i class="fa fa-remove"></i></a>                          
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->appends(Input::except('page'))->links('includes.pagination')}}
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    <!-- END Page Content -->

<script>
  function userDelete(user_id, user_name){
    swal({
      title: '{{__("messages.delete")}}',
      text: '{{__("messages.confirm_delete")}} '+user_name+'?',
      icon: "warning",
      buttons: true,
      dangerMode: true,
      confirmButtonText: '{{__("messages.confirm")}}',
      cancelButtonText: '{{__("messages.cancel")}}',
    }).then((result) => {
      if (result) {
        window.location = '{{url("users/delete")}}/'+user_id;
      }
    })
  }
</script>
@endsection

