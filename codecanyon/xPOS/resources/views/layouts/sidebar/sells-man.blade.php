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


                <li class="">
                    <a href="{{url('/outlet/id='.$outlet_id.'/pos')}}" class="waves-effect"><i class="ti-notepad"></i> <span> POS </span> </a>
                </li>

                <li class="">
                    <a href="{{url('/outlet/id='.$outlet_id.'/products')}}" class="waves-effect"><i class=" ti-package"></i> <span> Products </span> </a>
                </li>


                <li class="text-muted menu-title">Setting</li>
                <li class="">
                    <a href="{{url('/outlet/id='.$outlet_id.'/profile')}}" class="waves-effect"><i class="ti-settings"></i><span>Settings </span></a>
                </li>



            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
