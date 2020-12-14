<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Order</title>

    <link href="https://fonts.googleapis.com/css?family=Share+Tech|Share+Tech+Mono" rel="stylesheet">
    <style>

        .receipt {
            font-family: 'Share Tech Mono', monospace;
        }
        .print-btn{
            padding: 10px;
            border-radius: 2px;
        }

        @media print {
            .receipt {
                font-family: 'Share Tech Mono', monospace;
                /*font-family: 'Share Tech', sans-serif;*/
            }
            .print-head{
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="print-head">
    <center>
        <button onclick="window.location.replace('{{url('/home')}}')" class="print-btn">Dashboard</button>
        <button onclick="window.location.replace('{{url('/outlet/id='.$order->outlet->id.'/pos')}}')" class="print-btn">POS</button>
        <button class="print-btn" onclick="window.print()">Print</button>
    </center>
    <hr>
</div>

<div class="receipt">
    <center>
        <p>
            <span style="font-size: 26px;">{{$order->outlet->outlet_name}}</span> <br>
            {{$order->outlet->id}} <br>
            {{$order->outlet->location}} <br>
            TIN : {{$order->outlet->outletTax->tax_id}}
        </p>
    </center>
    <left>
        <p>
        Order No : {{str_pad($order->id,4,0,STR_PAD_LEFT)}}
        Ref No : {{$order->ref_number}} <br>
        Customer : {{$order->customer_id == 0 ? "Walk in customer" : $order->customer->name}}<br>
        User : {{$order->user ? $order->user->name  : 'Direct Order'}} <br>
        Date : {{$order->created_at->format('d-M-Y')}} <br>
        </p>

    </left>
    <table width="100%">
        <thead>
        <tr>
            <th width="10px">#</th>
            <th>Item</th>
            <th>Q</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; $subtotal = 0; ?>
        @foreach($order->products as $product)
            <?php $subtotal +=  $product->price * $product->quantity?>
            <tr>
                <td width="5px">{{$i++}}.</td>
                <td>{{$product->product->product_name}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->price * $product->quantity}}</td>
            </tr>
        @endforeach
        <tr>
            <td>Subtotal</td>
            <td>:</td>
            <td>{{$subtotal}}</td>
        </tr>
        <tr>
            <td>Discount</td>
            <td>:</td>
            <td>{{$order->discount}}</td>
        </tr>
        <tr>
            <td>Tax ({{$order->vat}})% </td>
            <td>:</td>
            <td>{{($subtotal * $order->vat)/100}}</td>
        </tr>
        <tr>
            <td>Gross Total</td>
            <td>:</td>
            <td>{{$gross = $subtotal - $order->discount}}</td>
        </tr>
        <tr>
            <td><h2>Total</h2></td>
            <td><h2>:</h2></td>
            <td>
                <h2>{{($gross + (($gross * $order->vat)/100))}}</h2>
            </td>
        </tr>
        @if($order->status == 1)
        <tr>
            <td>Cash Journal</td>
            <td>:</td>
            <td>{{$order->payment->cash_journal}}</td>
        </tr>
        <tr>
            <td>Change</td>
            <td>:</td>
            <td>{{$order->payment->change}}</td>
        </tr>
        <tr>
            <td>Payment Type</td>
            <td>:</td>
            <td>{{$order->payment->payment_type ==1 ? 'Cash' : $order->payment->payment_type ==2 ? 'Check' : 'Card'}}</td>
        </tr>
        @else
            <tr>
                <td>PAYMENT STATUS</td>
                <td>:</td>
                <td>DUE</td>
            </tr>
        @endif
        </tbody>
    </table>
    <center>
        <svg class="barcode" jsbarcode-value="{{$order->ref_number}}"></svg>
    </center>
</div>


<div class="print-head">
    <center>
        <button class="print-btn" onclick="window.print()">Print</button>
    </center>
    <hr>
</div>
<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
<script>
    JsBarcode(".barcode","Smallest width",{
        height: 25
    }).init();
    window.print();
</script>
</body>
</html>