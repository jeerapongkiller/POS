<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @include('assets.css')
    @yield('extra-css')
</head>
<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    @guest


    @else

    @include('layouts.nav')
        @admin
            @include('layouts.sidebar.admin')
        @endadmin

        @outletOwner
            @include('layouts.sidebar.outlet-owner')
        @endoutletOwner

        @sells
            @include('layouts.sidebar.sells-man')
        @endsells

        @moderator
            @include('layouts.sidebar.modarator')
        @endmoderator

    @endguest

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">

                    @yield('content')
                </div>

            </div> <!-- container -->
        </div> <!-- content -->

        {{--<footer class="footer">--}}
            {{--© 2016. All rights reserved.--}}
        {{--</footer>--}}

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->




</div>

<!-- Scripts -->
@include('assets.js')
@yield('extra-js')
</body>
</html>
