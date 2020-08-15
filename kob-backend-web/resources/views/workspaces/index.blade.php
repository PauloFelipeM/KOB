@extends('layouts.backend')

<!-- @section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection -->

@section('title')
{{__('workspace.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-primary mt-5 row">             
               <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 my-3 my-md-0">
                            <form action="/workspaces" method="GET">
                                @csrf
                                <div class="input-group text-center">
                                    <input type="text" class="form-control" placeholder="{{__('workspace.search_placeholder')}}" id="page-header-search-input" name="search">
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
                            <a href="{{url('/workspaces/create')}}" class="btn btn-primary btn-block btn-create">{{ __('workspace.btn_create') }}</a>    
                        </div>
                    </div>
               </div>  
            </div>
            <div class="block-content block-content-full">
                <table class="table table-striped table-vcenter js-dataTable-full table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>{{ __('workspace.title') }}</th>
                            <th>{{__('workspace.domain')}}</th>
                            <th>{{__('workspace.address')}}</th>
                            <th>{{__('workspace.id_number')}}</th>
                            <th>{{__('workspace.phone')}}</th>
                            <th>{{__('workspace.contact')}}</th>                                                                                    
                            <th>{{__('workspace.email')}}</th>
                            <th>{{__('workspace.admins')}}</th>
                            <th>{{__('workspace.users')}}</th>
                            <th>{{__('workspace.disabled')}}</th>
                            <th width="1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workspaces as $workspace)
                        <tr>
                            <td class="text-center">{{ $workspace->id }}</td>
                            <td class="font-w600">
                                <a href="{{url('/workspaces/view/'.$workspace->id)}}">{{ $workspace->title }}</a>
                            </td>
                            <td>{{ $workspace->domain }}</td>                                                                             
                            <td>{{ $workspace->address }}</td>
                            <td>{{ $workspace->id_number }}</td>
                            <td>{{ $workspace->phone }}</td>
                            <td>{{ $workspace->contact }}</td>
                            <td>{{ $workspace->email }}</td>
                            <td>
                                @foreach($workspace->admin_list as $admin)
                                    <div title="{{ $admin->user->email}}">{{ $admin->user->name }}</div>                                    
                                @endforeach
                            </td>
                            <td>{{ count($workspace->accesses) }}</td>
                            <td>
                                @if($workspace->disabled)
                                    {{__('messages.yes')}}
                                @else
                                    {{__('messages.no')}}
                                @endif
                            </td>
                            <td nowrap>
                                <a href="{{url('/accesses/'.$workspace->id)}}" class="btn btn-secondary"
                                    data-toggle="tooltip" data-placement="top" title="{{__('workspace.users')}}"><i class="fa fa-users"></i></a>
                                <a href="{{url('/workspaces/update/'.$workspace->id)}}" class="btn btn-secondary"
                                    data-toggle="tooltip" data-placement="top" title="{{__('workspace.update')}}"><i class="fa fa-edit"></i></a>
                                <a href="javascript:workspaceDelete('{{$workspace->id}}', '{{$workspace->title}}')" class="btn btn-danger"
                                    data-toggle="tooltip" data-placement="top" title="{{__('default.btn_delete')}}"><i class="fa fa-remove"></i></a>                          
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$workspaces->appends(Input::except('page'))->links('includes.pagination')}}
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    <!-- END Page Content -->

<script>
  function workspaceDelete(workspace_id, workspace_title){
    swal({
      title: '{{__("messages.delete")}}',
      text: '{{__("messages.confirm_delete")}} '+workspace_title+'?',
      icon: "warning",
      buttons: true,
      dangerMode: true,
      confirmButtonText: '{{__("messages.confirm")}}',
      cancelButtonText: '{{__("messages.cancel")}}',
    }).then((result) => {
      if (result) {
        window.location = '{{url("workspaces/delete")}}/'+workspace_id;
      }
    })
  }
</script>
@endsection

