@extends('welcome')

@section('content')

    <div style="margin-top: 75px;">
        <div class="container">
            <div class="row">
                @foreach($outlets as $key => $outlet)
                    <a href="{{url('/outlet/id='.$outlet->id)}}">
                        <div class="col-md-4">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="img-responsive" src="{{url($outlet->logo !=  '' ? : '/images/placeholder.png')}}" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <h3>{{$outlet->outlet_name}}</h3>
                                        <small>{{$outlet->location}}</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

@endsection