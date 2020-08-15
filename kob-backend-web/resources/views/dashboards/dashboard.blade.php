@extends('layouts.backend')

@section('title')
    {{__('dashboard.title_web')}}
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(count($cards)>0)
                <div class="card">
                    
                    <div class="h3 card-header">{{__('card.approval_line')}}</div>

                    <div class="card-body">
                        @foreach($cards as $card)
                            <div>
                                <a href="{{url('cards/validate/'.$card->id)}}">
                                    {{$card->access->user->name}} - {{__('card.validate')}}
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif            
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
