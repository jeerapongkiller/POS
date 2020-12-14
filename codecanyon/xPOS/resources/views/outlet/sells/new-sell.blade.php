<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>POS</title>

    @include('assets.css')
    <link href="{{url('/dashboard/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">

    <style>
        .widget-panel {
            padding: 10px !important;
            margin: 0px !important;
        }

        tr {display: block; }
        th, td:first-child{ width: 10px; }
        th, td:nth-child(2){ width: 150px; }
        #cartTable tbody { display: block; height: 380px; overflow: auto;}

    </style>

</head>
<body>
@include('outlet.sells.modal.hold-orders')
@include('outlet.sells.modal.customer-orders')

<div class="container">
    <input type="hidden" id="outlet_id" value="{{$outlet_id}}">
    <input type="hidden" id="outlet_tax" value="{{$tax->tax}}">
    <input type="hidden" id="outlet_tin" value="{{$tax->tax_id}}">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="button-list pull-right m-t-15">
                <button type="button" class="btn btn-success waves-effect waves-light">
                    <span class="btn-label"><i class="fa fa-th"></i></span>POS
                </button>

                <button  data-toggle="modal" data-target="#holdOrdersModal" type="button" class="btn btn-danger waves-effect waves-light">
                    <span class="btn-label"><i class="fa fa-hand-stop-o"></i></span>Hold Orders
                </button>

                <button data-toggle="modal" data-target="#customerModal" type="button" onclick="$(this).getCustomerOrders()" class="btn btn-info waves-effect waves-light">
                    <span class="btn-label"><i class="fa fa-exclamation"></i></span>Customer Order
                </button>
            </div>

            <a href="{{url('/outlet/id='.$outlet_id.'/dashboard')}}"
               class="btn btn-info waves-effect waves-light m-t-15">
                <span class="btn-label"><i class="fa fa-exclamation"></i></span>Dashboard
            </a>

            <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="{{url('/images/loading.gif')}}" alt="">

        </div>
    </div>
    <br>


    <div class="row">
        <div class="col-md-4">
            <div class="card-box">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10">
                            <select name="" id="customer" class="form-control">
                                <option value="0">Walk in customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button data-toggle="modal" data-target="#newCustomer" class="btn btn-success"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="input-group m-t-5">
                        <form action="" id="searchBarCode">
                            {{csrf_field()}}
                            <input type="text" required name="product_sku" class="form-control" placeholder="Scan bar code or enter sku number then hit enter" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <input type="submit" style="display:none;">
                        </form>
                        <span class="input-group-addon" id="basic-addon2">
                            <i class="glyphicon glyphicon-ok"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <table class="table m-0" id="cartTable">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th width="150px">Product Nmae</th>
                            <th width="170px">Qt.</th>
                            <th>Price</th>
                            <th width="5px">
                                <button onclick="$(this).cancelOrder()" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>

                    </table>
                </div>

                <hr>
               <div class="m-t-5">
                   <div class="row">
                       <div class="col-md-3">Total Item(s)</div>
                       <div class="col-md-3">: <sapn id="total">0</sapn></div>
                       <div class="col-md-3">Price :</div>
                       <div class="col-md-3">: <span id="price">0.0</span></div>
                   </div>
                   <div class="row">
                       <div class="col-md-3">Discount</div>
                       <div class="col-md-3"><input class="form-control" type="number" id="inputDiscount" oninput="$(this).calculateCart();"></div>
                       <div class="col-md-3">Gross Price (inc <span id="taxInfo"></span>% Tax)</div>
                       <div class="col-md-3"><h3 id="gross_price">0.00</h3></div>
                   </div>

               </div>

                <div class="button-list pull-right">
                    <button  onclick="$(this).cancelOrder()" type="button" class="btn btn-danger waves-effect waves-light">
                        <span class="btn-label"><i class="fa fa-ban"></i></span>Cancel
                    </button>

                    <button type="button" id="hold" class="btn btn-default waves-effect waves-light">
                        <span class="btn-label"><i class="fa fa-hand-paper-o"></i></span>Hold
                    </button>

                    <button type="button" id="payButton" class="btn btn-success waves-effect waves-light">
                        <span class="btn-label"><i class="fa fa-money"></i></span>Pay
                    </button>
                </div>
                <hr>

            </div>
        </div>
        <div class="col-md-8">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" id="search" class="form-control" placeholder="Search product by name or sku">
                    </div>
                    <div class="col-md-8">
                        <div class="">
                            <button type="button" id="all"
                                    class="btn btn-categories btn-default waves-effect waves-light">All
                            </button>
                            @foreach($categories as $category)
                                <button type="button" id="{{$category->category_name}}"
                                        class="btn btn-categories btn-default waves-effect waves-light">{{$category->category_name}}</button>
                            @endforeach

                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" id="parent" style="height: 600px; overflow: scroll;">
                    @foreach($products as $product)
                        <div class="col-lg-2 box {{$product->category->category_name}}"
                             onclick="$(this).addToCart('{{$product->id}}')">
                            <div class="widget-panel widget-style-2 ">
                                <center>
                                    <img src="{{url($product->image ? $product->image : 'http://via.placeholder.com/100x100')}}"
                                         height="100px" width="100px" alt="">
                                </center>
                                <div class="text-muted m-t-5 text-center" style="height: 70px"><span
                                            class="name">{{$product->product_name}}</span> <br>
                                    <span class="sku">{{$product->product_sku}}</span></div>
                                <h4 class="text-success text-center"><b data-plugin="counterup">{{$product->price}}</b>
                                </h4>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</div>

@include('outlet.sells.modal.new-due-order')
@include('outlet.sells.modal.new-payment')
@include('outlet.sells.modal.new-customer')

<!-- Sweet-Alert  -->
<script src="{{url('/dashboard/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>

<script src="{{url('/dashboard/js/jquery.min.js')}}"></script>
<script src={{url('dashboard/js/bootstrap.min.js')}}></script>

<script src="{{url('/dashboard/js/product-filter.js')}}"></script>
<script src="{{url('/dashboard/js/pos.js')}}"></script>

<script src="{{url('/dashboard/js/customer-order.js')}}"></script>
<script src="{{url('/dashboard/js/hold-order.js')}}"></script>
<script src="{{url('/dashboard/js/pay-order.js')}}"></script>



</body>
</html>