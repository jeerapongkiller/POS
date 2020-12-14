@extends('layouts.app')

@section('title') Dashboard @endsection

@section('extra-css')
    <style>
        @media print {
            .btn,p{
                display: none;
            }

            .should-not-print{
                display: none;
            }
        }
    </style>
@endsection

@section('content')

    <?php


    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="text-center">
                    <div id="qrcode"></div>
                    <p>You can print his QR Code and place it in-front of your outlet so your customer can directly order by scan it.</p>
                    <button onclick="window.print()" class="btn btn-info">Print QR-Code</button>
                </div>
            </div>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <a href="{{url('/outlet/id='.$outlet_id.'/pos')}}">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-success pull-left">
                        <i class="md md-receipt text-success"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter">POINT OF SALE</b></h3>
                        <p class="text-muted">Click to go to point of sale</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div class="col-md-12 col-lg-6">
            <a href="{{url('/outlet/id='.$outlet_id.'/products')}}">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-success pull-left">
                        <i class="md md-receipt text-success"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter">PRODUCTS</b></h3>
                        <p class="text-muted">Click to see products</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

@endsection

@section('extra-js')
    <script src="{{url('/dashboard/js/jquery.qrcode.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#qrcode').qrcode("{{url('/outlet/id='.$outlet_id)}}");
        })
    </script>
@endsection
