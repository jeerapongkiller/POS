<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Install</title>
    <link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">
    <style>

        .parsley-errors-list{
            color: red;
            list-style: none;
            margin-left: -35px;
        }

        .parsley-error{
            border-color: red;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Welcome to POSx Installation process</h2>
        <p>Please follow the steps to complete the process</p>
        @if(session('step_error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{session('step_error')}}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
             @yield('content')
        </div>

    </div>
    <script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('js/popper.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/parsley.min.js')}}"></script>
    @yield('js')
</body>
</html>