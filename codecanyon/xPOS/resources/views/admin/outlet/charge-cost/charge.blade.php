@extends('layouts.app')

@section('title') Outlets  @endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="row">
                    @foreach($outlets as $outlet)
                        <div class="col-md-3">
                            <div class="card-box">
                                <center>
                                    <img width="100px" height="100px"
                                         src="{{url($outlet->logo != '' || $outlet->logo != null ? $outlet->logo : '/images/placeholder.png')}}"
                                         alt="">
                                </center>
                                <h4 class="text-center">{{$outlet->outlet_name}}</h4>

                                <p>Total Sell Charge : {{$outlet->outletCharges->sum('charge')}} % <br>
                                <?php
                                    $due = 0;
                                    foreach (\App\Model\Sell::where('outlet_id',$outlet->id)->where('sell_charges','!=',0)->cursor() as $sell){
                                        $net_value = $sell->sell_value - $sell->discount;
                                        $due += ($net_value * $sell->sell_charges) / 100;
                                    }
                                    $total_payment = $outlet->outletPayment->sum('payment');
                                    $last_payment =$outlet->outletPayment->last();
                                ?>
                                Due  : {{$due - $total_payment}} <br>
                                Last payment  : {{$last_payment ? $last_payment->created_at->format('d-M-Y') : 'No payment found'}}</p>
                                @if($due - $total_payment > 0)
                                <a href="{{url('/new-payment/outlet='.$outlet->id)}}" class="btn btn-success btn-sm">Make Payment</a>
                                @endif
                                <a href="{{url('/outlet-id='.$outlet->id.'/payment-history')}}" class="btn btn-info btn-sm">Payment History</a>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection