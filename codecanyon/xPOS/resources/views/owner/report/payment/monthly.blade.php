<?php

$payments = \App\Model\OutletPayment::where('outlet_id',$outlet_id)
    ->whereBetween('created_at',array($start_date,$end_date))
    ->get()
    ->groupBy(function ($data){
        return $data->created_at->format('M-Y');
    });

$currency = config('app.currency');

?>



@foreach($payments as $payment)

    <h3>{{$payment[0]->created_at->format('M-Y')}}  </h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Date</th>
            <th>Payable Amount</th>
            <th>Payment</th>
            <th>Due</th>
            <th>Paid to</th>
            <th>Note</th>
        </tr>
        </thead>
        <tbody>
        <?php $total_payment = 0 ?>
        @foreach($payment as $payment_details)
            <?php $total_payment += $payment_details->payment; ?>
            <tr>
                <td>{{$payment_details->created_at->format('d-M-Y')}}</td>
                <td>{{$currency}} {{$payment_details->payable_amount}}</td>
                <td>{{$currency}} {{$payment_details->payment}}</td>
                <td>{{$currency}} {{$payment_details->due_amount}}</td>
                <td>{{$payment_details->user->name}}</td>
                <td>{{$payment_details->note}}</td>
            </tr>
        @endforeach
        <tr>
            <td>Total Payment</td>
            <td>{{$currency}} {{$total_payment}}</td>
        </tr>
        </tbody>
    </table>

@endforeach