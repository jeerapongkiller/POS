<?php

$format = 'W';

if($type == 0){
    $format = 'W-Y';
}elseif ($type == 1){
    $format = 'M-Y';
}else{
    $format = 'W-Y';
}

$payments = \App\Model\OutletPayment::where('outlet_id',$outlet_id)
    ->whereBetween('created_at', array($start_date, $end_date))
    ->get()
    ->groupBy(function ($data) use ($format) {
        return $data->created_at->format($format);
    });
$currency = config('app.currency');

?>


@forelse($payments as $payment)
    <?php
    $week = \Illuminate\Support\Carbon::parse($payment[0]->created_at)->format('W');
    $year = \Illuminate\Support\Carbon::parse($payment[0]->created_at)->format('Y');
    $date = \Illuminate\Support\Carbon::now();
    $date->setISODate($year,$week);
    $week_start_date = $date->startOfWeek();
    ?>

    @if($type == 1)
        <h3>{{$payment[0]->created_at->format('M-Y')}}  </h3>
    @else
        <h3>{{$week_start_date->format('d-M-Y')}} - {{$week_start_date->addDay(6)->format('d-M-Y')}} </h3>
    @endif

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

@empty

    Noting found

@endforelse
