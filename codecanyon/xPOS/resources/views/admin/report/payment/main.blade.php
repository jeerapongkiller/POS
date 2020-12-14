@extends('layouts.app')

@section('extra-css')
    <link rel="stylesheet" href="{{url('/dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{url('/dashboard/plugins/bootstrap-daterangepicker/daterangepicker.css')}}">
    <style>
        @media print {
            #reportGen{
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row" id="reportGen">
        <div class="col-md-12">
            <div class="card-box">
                <div class="row m-b-30">
                    <div class="col-sm-12">
                        <h5><b>Select Date</b></h5>

                        <form class="form-inline" role="form" id="report" method="post">
                            <div class="form-group m-l-10">
                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                <select name="" id="outlet" class="form-control">
                                    <option value="0" {{$outlet_id == 0 ? 'selected' : ''}}>All Outlet</option>
                                    @foreach($outlets as $outlet)
                                        <option value="{{$outlet->id}}" {{$outlet_id == $outlet->id ? 'selected' : ''}}>{{$outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($start_date)->format('m/d/Y')}}" id="start" />
                                    <span class="input-group-addon bg-custom b-0 text-white">to</span>
                                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($end_date)->format('m/d/Y')}}" id="end" />
                                </div>

                            </div>

                            <div class="form-group m-l-10">
                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                <select name="" id="type" class="form-control">
                                    <option value="0" {{$type == 0 ? 'selected' : ''}}>Weekly report</option>
                                    <option value="1" {{$type == 1 ? 'selected' : ''}}>Monthly report</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md">Make Report</button>
                        </form>
                    </div>


                </div>

            </div>
        </div>
    </div>

    @if($outlet_id == 0)
        <div class="card-box">
            @include('admin.report.payment.all-outlet')
        </div>

    @else
       <div class="card-box">
           @include('admin.report.payment.selected-outlet')
       </div>
    @endif

@endsection

@section('extra-js')
    <script src="{{url('/dashboard/plugins/moment/moment.js')}}"></script>
    <script src="{{url('/dashboard/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
    <script src="{{url('/dashboard/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{url('/dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{url('/dashboard/plugins/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>

    <script src="{{url('/dashboard/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('/dashboard/pages/jquery.form-pickers.init.js')}}"></script>

    <script>
        $(document).ready(function () {

            $("#report").on('submit',function (e) {
                e.preventDefault();
                var start_date = moment($("#start").val()).format('YYYY-M-DD');
                var end_date = moment($("#end").val()).format('YYYY-M-DD');
                var type = $("#type").val();
                var outlet_id = $("#outlet").val();
                window.location.replace('/report/payment/outlet-id='+outlet_id+'/start='+start_date+'/end='+end_date+'/type='+type);
            })
        })
    </script>
@endsection
