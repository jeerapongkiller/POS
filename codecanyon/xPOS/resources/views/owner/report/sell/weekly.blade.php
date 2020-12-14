<?php

    $sells = \App\Model\Sell::where('outlet_id',$outlet_id)
        ->where('status',1)
        ->whereBetween('created_at',array($start_date,$end_date))
        ->get()
        ->groupBy(function ($data){
            return $data->created_at->format('W');
        });



?>



@foreach($sells as $sell)
    <?php

    $week = \Illuminate\Support\Carbon::parse($sell[0]->created_at)->format('W');
    $year = \Illuminate\Support\Carbon::parse($sell[0]->created_at)->format('Y');
    $date = \Illuminate\Support\Carbon::now();
    $date->setISODate($year,$week);
    $week_start_date = $date->startOfWeek();


    ?>
    <h3>{{$week_start_date->format('d-M-Y')}} - {{$week_start_date->addDay(6)->format('d-M-Y')}} </h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Order No</th>
            <th>Ref No</th>
            <th>Order Type</th>
            <th>Payment Type</th>
            <th>Sell Value</th>
            <th>Tax</th>
            <th>Tax Value</th>
            <th>Sell Charge</th>
            <th>Sell Charge Value</th>
            <th>Discount</th>
            <th>Customer</th>
            <th>Sold By</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $total_sell_value = 0;
            $net_sell = 0;
            $total_tax = 0;
            $total_sell_charge = 0;
        ?>
        @foreach($sell as $sell_details)
            <?php
            $sell_value = 0;


            foreach ($sell_details->products as $value){
                $sell_value += $value->price * $value->quantity;
            }

            $sell_value_after_discount = $sell_value - $sell_details->discount;

            $total_sell_value += $sell_value_after_discount;

            $tax_value = ($sell_details->vat * $sell_value_after_discount) / 100;

            $total_tax += $tax_value;

            $price_after_tax = $sell_value_after_discount - $tax_value;

            $net_sell += $price_after_tax;

            $sell_charge_value = ($price_after_tax * $sell_details->sell_charges) / 100;

            $total_sell_charge += $sell_charge_value;

            ?>
            <tr>
                <td>{{$sell_details->id}}</td>
                <td>{{$sell_details->ref_number}}</td>
                <td>{{$sell_details->order_type == 1 ? 'POS Order' : 'Customer Order'}}</td>
                <td>
                    @if($sell_details->payment->payment_type == 0)
                        Cash
                    @elseif($sell_details->payment->payment_type == 2)
                        <p>Check <br> {{$sell_details->payment->payment_info}}</p>
                    @else
                        <p>Card <br> {{$sell_details->payment->payment_info}}</p>
                    @endif
                </td>
                <td>
                      {{config('app.currency')}} {{$sell_value}}
                </td>
                <td>{{$sell_details->vat}} %</td>
                <td>{{config('app.currency')}} {{ $tax_value }}</td>
                <td>{{$sell_details->sell_charges}} %</td>
                <td>{{config('app.currency')}} {{ number_format($sell_charge_value,2) }}</td>
                <td>{{$sell_details->discount}}</td>
                <td>{{$sell_details->customer_id == 0 ? 'Walk in customer' : $sell_details->customer->name }}</td>
                <td>{{$sell_details->user->name}}</td>
            </tr>
        @endforeach
        <tr>
            <td>Total Sell (Inc Tax) </td>
            <td>:</td>
            <td>{{config('app.currency')}} {{number_format($total_sell_value,2)}}</td>
        </tr>
        <tr>
            <td>Total Tax </td>
            <td>:</td>
            <td>{{config('app.currency')}} {{number_format($total_tax,2)}}</td>
        </tr>
        <tr>
            <td>Net Sell</td>
            <td>:</td>
            <td>{{config('app.currency')}} {{number_format($net_sell,2)}}</td>
        </tr>
        <tr>
            <td>Total Sell Charge </td>
            <td>:</td>
            <td>{{config('app.currency')}} {{number_format($total_sell_charge,2)}}</td>
        </tr>
        </tbody>
    </table>
    {{--{{$sell}}--}}
@endforeach