<link href="{{url('dashboard/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('dashboard/css/core.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('dashboard/css/components.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('dashboard/css/icons.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('dashboard/css/pages.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('dashboard/css/responsive.css')}}" rel="stylesheet" type="text/css" />

<style type="text/css">
    #image-preview {
        width: 200px;
        height: 200px;
        position: relative;
        overflow: hidden;
        background-color: #ffffff;
        color: #ecf0f1;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
    #image-preview input {
        line-height: 200px;
        font-size: 200px;
        position: absolute;
        opacity: 0;
        z-index: 10;
    }
    #image-preview label {
        position: absolute;
        z-index: 5;
        opacity: 0.8;
        cursor: pointer;
        background-color: #bdc3c7;
        width: 200px;
        height: 50px;
        font-size: 20px;
        line-height: 50px;
        text-transform: uppercase;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        text-align: center;
    }
</style>


<link href="{{url('/dashboard/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">

<script src="{{url('dashboard/js/modernizr.min.js')}}"></script>