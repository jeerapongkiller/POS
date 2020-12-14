<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

                <li class="text-muted menu-title">Navigation</li>

                <li class="">
                    <a href="{{url('/outlet/id='.$outlet_id.'/dashboard')}}" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class=" ti-pie-chart"></i> <span> Sell Charge </span> <span class="menu-arrow"></span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/sell-charge')}}">Due</a></li>
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/sell-charge-payment')}}">Payments</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-money"></i> <span> Sells </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/pos')}}">New Sell</a></li>
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/sells')}}">All Sell</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-printer"></i> <span> Reports </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <?php
                           $date = new Carbon\Carbon;
                        ?>
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/sell-report/start='.$date->format('Y-m-d').'/end='.$date->subDay(7)->format('Y-m-d').'/type=0')}}">Sell Report</a></li>
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/payment-report/start='.$date->format('Y-m-d').'/end='.$date->subDay(7)->format('Y-m-d').'/type=0')}}">Payment Report</a></li>
                    </ul>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class=" ti-user"></i><span> Sells Man </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/new-sells-man')}}">New Sells Man</a></li>
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/sells-men')}}">All Sells Man</a></li>
                    </ul>
                </li>



                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span> Product </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/new-product')}}">New Product</a></li>
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/products')}}">All Product</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-layers-alt"></i> <span> Product Categories </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/new-category')}}">New Category</a></li>
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/categories')}}">All Categories</a></li>
                    </ul>
                </li>

                <li class="text-muted menu-title">Setting</li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class=" ti-settings"></i><span>Settings </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/web-site-setting')}}">Web Site</a></li>
                        <li><a href="{{url('/outlet/id='.$outlet_id.'/profile')}}">Profile</a></li>
                    </ul>
                </li>





            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
