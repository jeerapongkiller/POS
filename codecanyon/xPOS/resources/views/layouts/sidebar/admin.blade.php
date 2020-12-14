<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

                <li class="text-muted menu-title">Navigation</li>

                <li class="">
                    <a href="{{url('/home')}}" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> </a>
                </li>

                <li class="">
                    <a href="{{url('/outlet-charge')}}" class="waves-effect"><i class="ion-cash"></i> <span> Sell Charges </span> </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ion-outlet"></i> <span> Outlets </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/new-outlet')}}">New outlet</a></li>
                        <li><a href="{{url('/outlets')}}">Outlets</a></li>
                    </ul>
                </li>
                <?php
                $date = new Carbon\Carbon;
                ?>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-printer"></i> <span> Reports </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/report/payment/outlet-id=0/start='.$date->subDay(7)->format('Y-m-d').'/end='.$date->format('Y-m-d').'/type=0')}}">Outlet Payment</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ion-cash"></i><span> Charges </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/new-charge')}}">New Charge</a></li>
                        <li><a href="{{url('/charges')}}">Outlet Charges</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i> <span> Users </span><span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/new-employee')}}">New User</a></li>
                        <li><a href="{{url('/employees')}}">Users</a></li>
                    </ul>
                </li>

                <li class="text-muted menu-title">Setting</li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-settings"></i><span>Settings </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/install/mail')}}">App Setup</a></li>
                        <li><a href="{{url('/profile')}}">Profile</a></li>
                    </ul>
                </li>



            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
