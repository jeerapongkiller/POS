@extends('layouts.app')

@section('title') Sell Report @endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('/dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{url('/dashboard/plugins/bootstrap-daterangepicker/daterangepicker.css')}}">
    <style>
        @media print {
            #reportGen, .floating-button{
                display: none;
            }
        }
        .floating-button{
            position: fixed;
            bottom: 0;
            right: 0;
            margin-bottom: 55px;
            margin-right: 25px;
        }

        .floating-button button{
            border-radius: 50%;
        }

        .floating-button button i{
            padding: 10px;
        }
    </style>
@endsection

@section('content')
    <input type="hidden" value="{{$outlet_id}}" id="outlet_id">
    <div class="row" id="reportGen">
        <div class="col-md-12">
            <div class="card-box">
                <div class="row m-b-30">
                    <div class="col-sm-12">
                        <h5><b>Select Date</b></h5>

                        <form class="form-inline" role="form" id="report" method="post">
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

    <div class="floating-button">
        <button onclick="window.print()" class="btn btn-primary"><i class="fa fa-print fa-3x"></i></button>
    </div>

    @if($type == 0)
        <div class="card-box">
            @include('owner.report.payment.weekly')
        </div>

    @elseif($type == 1)
        <div class="card-box">
            @include('owner.report.payment.monthly')
        </div>

    @else
        Type Incorrent
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
            var outlet_id = $("#outlet_id").val();
            $("#report").on('submit',function (e) {
                e.preventDefault();
                var start_date = moment($("#start").val()).format('YYYY-M-DD');
                var end_date = moment($("#end").val()).format('YYYY-M-DD');
                var type = $("#type").val();
                window.location.replace('/outlet/id='+outlet_id+'/payment-report/start='+start_date+'/end='+end_date+'/type='+type);
            })
        })
    </script>
@endsection
