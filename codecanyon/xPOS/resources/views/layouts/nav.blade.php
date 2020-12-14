<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            {{--<a href="{{url('/home')}}" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Ub<i--}}
                            {{--class="md md-album"></i>ld</span></a>--}}
            <!-- Image Logo here -->
            <a href="{{url('/')}}" class="logo">
            <i class="icon-c-logo"> <img src="{{url('/images/logo1.jpg')}}" height="42"/> </i>
            <span><img src="{{url('/images/logo1.jpg')}}" height="20"/></span>
            </a>
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                @guest

                    @else
                        <div class="pull-left">
                            <button class="button-menu-mobile open-left waves-effect waves-light">
                                <i class="md md-menu"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>




                        <ul class="nav navbar-nav hidden-xs">
                            <li>
                                <a href="">
                                    <img id="loading" style="margin-left: 355px" height="60px" src="{{url('/images/loading-2.gif')}}" alt="">
                                </a>
                            </li>
                        </ul>
                        @endguest

                        <ul class="nav navbar-nav navbar-right pull-right">
                            @guest
                                <li class="top-menu-item-xs">
                                    <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg"
                                       class="dropdown-toggle waves-effect waves-light"
                                       data-toggle="dropdown" aria-expanded="true">
                                        <i class=" md-add-shopping-cart"></i>
                                        <span id="cartItems" class="badge badge-xs badge-danger">0</span>
                                    </a>
                                </li>
                                <li><a href="{{route('login')}}" class="waves-effect waves-light">Login</a></li>

                                @else

                                    <li class="dropdown top-menu-item-xs">
                                        <a href="" class="dropdown-toggle profile waves-effect waves-light"
                                           data-toggle="dropdown"
                                           aria-expanded="true"><img src="{{url(auth()->user()->image != '' || auth()->user()->image != null ? auth()->user()->image : '/images/placeholder.png' )}}"
                                                                     alt="user-img"
                                                                     class="img-circle"> </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{url('/home')}}"><i class="ti-home m-r-10 text-custom"></i>
                                                    Dashboard</a>
                                            </li>
                                            <li><a href="{{url('/profile')}}"><i
                                                            class="ti-user m-r-10 text-custom"></i> Settings</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                                            class="ti-power-off m-r-10 text-danger"></i> Logout</a>
                                            </li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </ul>
                                    </li>
                                    @endguest
                        </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->