<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('assets.css')
    <title>Select Outlet</title>
</head>
<body>
<div class="container">
    <!-- Page-Title -->
    <center>
        <h4 class="page-title">Select Outlet</h4>
        <p class="text-muted page-title-alt">Select outlet form the list bellow ! <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a> </p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </center>

    <div class="row">
        @foreach(auth()->user()->userOutlet as $outlet)
            <a href="{{url('/outlet/id='.$outlet->id.'/dashboard')}}">
                <div class="col-md-6 col-lg-3">
                    <div class="widget-bg-color-icon card-box fadeInDown animated">
                        <div class="bg-icon bg-icon-info pull-left">
                            <i class="md md-attach-money text-info"></i>
                        </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b class="counter">{{$outlet->outlet_name}}</b></h3>
                            <p class="text-muted">{{$outlet->location}}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

</body>
</html>

