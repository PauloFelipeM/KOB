@extends('layouts.backend')

@section('title')
{{__('user.page_title') }}
@stop

@section('content')
    <!-- Page Content -->
        <!-- Dynamic Full -->
        <div class="block">
            <form action="{{url('/users/store/'.$user->id)}}" method="post">
                @csrf
                <div class="block-header block-header-primary">
                    <h3 class="block-title">{{ __('user.update') }}</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name">{{__('user.name')}}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $user->name)}}" autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="role">{{__('user.role')}}</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="">{{__('user.select_role')}}</option>
                                @foreach($roles as $key => $role)
                                    <option value="{{ $key }}" {{ ( $key == $user->role) ? 'selected' : '' }} > {{ $role }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="email">{{__('user.email')}}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email', $user->email)}}" autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number">{{__('user.phone_number')}}</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{old('phone_number', $user->phone_number)}}" autocomplete="email">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                                
                <div class="block-content block-content-full text-right">
                    <a href="{{url('users')}}" class="btn btn-secondary pull-left">
                      {{__('default.btn_back')}}
                    </a>
                    <button type="submit" class="btn btn-primary">{{ __('default.btn_update') }}</button>
                </div>
            </form>
        </div>
        <!-- END Dynamic Full -->
    <!-- END Page Content -->
@endsection
