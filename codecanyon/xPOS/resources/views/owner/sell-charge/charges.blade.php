@extends('layouts.app')

@section('title') Sell Charge @endsection

@section('content')
    Sell Charge
    <p>Total Sell Charge : {{$outlet->outletCharges->sum('charge')}} % <br>
        <?php
        $due = 0;
        foreach (\App\Model\Sell::where('outlet_id',$outlet->id)->where('sell_charges','!=',0)->cursor() as $sell){
            $due  += ($sell->sell_value * $sell->sell_charges) / 100;
        }
        $total_payment = $outlet->outletPayment->sum('payment');
        $last_payment =$outlet->outletPayment->last();
        ?>
        Due  : {{$due - $total_payment}} <br>
        Last payment  : {{$last_payment ? $last_payment->created_at->format('d-M-Y') : 'No payment found'}}</p>


@endsection