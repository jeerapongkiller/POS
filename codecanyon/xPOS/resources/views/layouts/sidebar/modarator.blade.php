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

                <?php
                $date = new Carbon\Carbon;
                ?>
                <li class="">
                    <a href="{{url('/report/payment/outlet-id=0/start='.$date->subDay(7)->format('Y-m-d').'/end='.$date->format('Y-m-d').'/type=0')}}" class="waves-effect"><i class=" icon-book-open"></i> <span> Payment History </span> </a>
                </li>


                <li class="text-muted menu-title">Setting</li>
                <li class="">
                    <a href="{{url('/profile')}}" class="waves-effect"><i class="ti-settings"></i><span>Settings </span></a>
                </li>



            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
