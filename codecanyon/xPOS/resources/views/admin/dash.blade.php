<div class="row should-not-print">
    <div class="col-md-6 col-lg-6">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md  md-stars text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{count(\App\Model\Outlet::all())}}</b></h3>
                <p class="text-muted">Total Outlet</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-pink pull-left">
                <i class="md  md-account-circle text-pink"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{count(\App\User::where('role',2)->orWhere('role',3)->get())}}</b></h3>
                <p class="text-muted">Total User</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row should-not-print">
    <div class="col-md-6 col-lg-6">
        <a href="{{url('/new-outlet')}}">
            <div class="widget-bg-color-icon card-box fadeInDown animated">
                <div class="bg-icon bg-icon-info pull-left">
                    <i class="md  md-add text-info"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b class="counter">Create new outlet</b></h3>
                    <p class="text-muted">Click to create new outlet</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-6">
        <a href="{{url('/new-employee')}}">
            <div class="widget-bg-color-icon card-box">
                <div class="bg-icon bg-icon-pink pull-left">
                    <i class="md md-add text-pink"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b class="counter">Create new user</b></h3>
                    <p class="text-muted">Click to create an user</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>