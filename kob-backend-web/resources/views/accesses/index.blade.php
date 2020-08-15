@extends('layouts.backend')

@section('title')
{{__('access.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-primary mt-5 row">             
               <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 my-3 my-md-0">
                            <form action="/accesses/{{$workspace->id}}" method="GET">
                                @csrf
                                <div class="input-group text-center">
                                    <input type="text" class="form-control" placeholder="{{__('access.search_placeholder')}}" id="page-header-search-input" name="search">
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
                            <a href="{{url('/accesses/create/'.$workspace->id)}}" class="btn btn-primary btn-block btn-create">{{ __('access.btn_create') }}</a>    
                        </div>
                    </div>
               </div>  
            </div>
            <div class="block-content block-content-full">
                <table class="table table-striped table-vcenter js-dataTable-full table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>{{ __('access.user') }}</th>
                            <th>{{ __('access.email') }}</th>
                            <th>{{ __('access.admin_access') }}</th>
                            <th>{{ __('access.manager_access') }}</th>
                            <th>{{ __('access.employee_access') }}</th>
                            <th>{{ __('access.blocked_access') }}</th>
                            <th width="1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accesses as $access)
                        <tr>
                            <td class="text-center">{{ $access->id }}</td>
                            <td><a href="{{url('users/view/'.$access->user_id)}}">{{ $access->user->name }}</a></td>
                            <td><a href="{{url('users?search='.$access->user->email)}}">{{ $access->user->email }}</a></td>
                            <td>
                                @if($access->is_admin) {{__('messages.yes')}}
                                @else {{__('messages.no')}}
                                @endif
                            </td>
                            <td>
                                @if($access->is_manager) {{__('messages.yes')}}
                                @else {{__('messages.no')}}
                                @endif
                            </td>
                            <td>
                                @if($access->is_employee) {{__('messages.yes')}}
                                @else {{__('messages.no')}}
                                @endif                            
                            </td>
                            <td>
                                @if($access->is_blocked) {{__('messages.yes')}}
                                @else {{__('messages.no')}}
                                @endif                            
                            </td>
                            <td nowrap>
                                <a href="{{url('/accesses/update/'.$access->id)}}" class="btn btn-secondary"
                                    data-toggle="tooltip" data-placement="top" title="{{__('access.update')}}"><i class="fa fa-edit"></i></a>                        
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$accesses->appends(Input::except('page'))->links('includes.pagination')}}
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    <!-- END Page Content -->
@endsection