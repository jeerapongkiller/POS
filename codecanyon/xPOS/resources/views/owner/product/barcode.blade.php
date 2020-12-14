@extends('layouts.app')

@section('title')Products @endsection

@section('extra-css')
    <style>
        @media print {
            .btn{
                display: none;
            }
        }
    </style>
@endsection


@section('content')
    <div class="card-box">
        @foreach($products as $product)
            <svg class="barcode" jsbarcode-value="{{$product->product_sku}}"></svg>
        @endforeach
        <center>
                <button onclick="window.print()" class="btn btn-lg btn-success">Print</button>
        </center>
    </div>


@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
    <script>
        window.print();
        JsBarcode(".barcode").init();
    </script>
@endsection