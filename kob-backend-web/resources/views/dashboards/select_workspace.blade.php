@extends('layouts.backend')

@section('title')
    {{__('dashboard.select_workspace')}}
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if(count($accesses)>0)		
				<div class="row">
				@foreach($accesses as $access)
					<div class="col-md-4">
						<div class="card mb-2 p-5" style="">
							<div class="card-body">
								<h5 class="card-title">{{$access->workspace->title}}</h5>
								<p class="card-text">{{$access->workspace->domain}}</p>
								<p class="card-text">
									<b>{{__('access.admin_access')}}:</b> @if($access->is_admin) {{__('messages.yes')}} @else {{__('messages.no')}} @endif
									<br><b>{{__('access.manager_access')}}:</b> @if($access->is_manager) {{__('messages.yes')}} @else {{__('messages.no')}} @endif
								</p>
								@if($access->workspace_disabled)
									<a href="javascript:void(0);" class="disabled btn btn-secondary btn-block">{{__('dashboard.disabled')}}</a>
								@else
									<a href="signin_workspace/<?=$access->id?>" class="btn btn-primary btn-block">{{__('auth.signin')}}</a>	
								@endif
							</div>
						</div>			
					</div>			
				@endforeach	
				</div>			
			@else
				<!-- <div class="col-md-12 text-center">
					<a href="dashboard/create_workspace" class="btn btn-primary">{{__('dashboard.create_workspace')}}</a>
				</div> -->
			@endif

        </div>
    </div>
</div>
<style>
.card {
	background-color: white;
	border: 1px solid #525252;
}
</style>
@endsection
