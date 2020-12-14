@extends('welcome')

@section('content')
    <style>
        .product{

        }
        .outlet{
            position: relative;
        }
        .image-text{
            position: absolute;
            top:50%;
            width: 100%;
            text-align: center;
        }
        .outlet-products{
            margin-top:15px;
        }
        .card-box:hover{
            background-color: transparent;
        }
        .cart{
            position: fixed;
            bottom: 0;
            right: 0;
            cursor: pointer;
        }
        .cart-items{
            font-size: 25px;
        }
    </style>

    <?php
        $outlet_website = \App\Model\OutletWebsite::where('outlet_id',$outlet->id)->first();
    ?>

    @if($outlet_website)
        <style>

            .card-box{
                background-color: {{$outlet_website->card_color}};
            }

            .product img{
                height: {{$outlet_website->image_height}}px;
                width: {{$outlet_website->image_width}}px;
            }
            .product h4{
                color: {{$outlet_website->product_title_color}};
                font-size: {{$outlet_website->product_title_size}}px;
            }


            .product .text-success{
                color: {{$outlet_website->price_color}};
                font-size: {{$outlet_website->price_size}}px;
            }

            .products:hover h4{
                color: {{$outlet_website->product_title_color_hover}};
            }

            .product:hover .text-success{
                color: {{$outlet_website->price_color_hover}};
            }

            .card-box:hover{
                background-color: {{$outlet_website->card_color_hover}};
            }
        </style>

        @else
        <style>
            .product img{
                height: 100px;
                width: 100px;
            }
        </style>
    @endif


    <input type="text" id="tax" value="{{$outlet->outletTax->tax}}">
    <input type="text" value="{{$outlet->outletTax->tax_id}}">
    <div style="margin-top: 75px">
        <div class="container">
            <div class="outlet">
                @if($outlet_website)
                    <img src="{{url($outlet_website->banner_img)}}" width="1500" height="350" alt="">
                    <div class="image-text">
                        <h2 style="color: '{{$outlet_website->title_one_color}}';font-size: {{$outlet_website->title_one_size}}px">{{$outlet_website->title_one}}</h2>
                        <h2 style="color: '{{$outlet_website->title_two_color}}';font-size: {{$outlet_website->title_two_size}}px">{{$outlet_website->title_two}}</h2>
                        {!! $outlet_website->text !!}
                    </div>
                @else
                <img src="http://via.placeholder.com/1500x350" alt="">
                <div class="image-text">
                   <h2>{{$outlet->outlet_name}}</h2>
                </div>
                @endif
            </div>
            <div class="outlet-products">
                @foreach($outlet->products as $product)
                    <a href="javascript:void(0)" onclick="$(this).productAddToCart('{{$product->id}}')">
                        <div class="col-md-3 card-box">
                            <center class="product">
                                <img src="{{url($product->image != '' || $product->image != null ? $product->image : '/images/placeholder.png')}}" width="100px" height="100px" alt="">
                                <h4>{{$product->product_name}}</h4>
                                <h2 class="text-success">{{config('app.currency')}} {{$product->price}}</h2>
                                <p>Click to add in cart</p>
                            </center>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>


    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">Your Cart</h4>
                </div>
                <div class="modal-body">
                    <table class="table" id="cartTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Q</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    <div class="m-t-5">
                        <div class="row">
                            <div class="col-md-3">Total Item(s)</div>
                            <div class="col-md-3">: <sapn id="total">0</sapn></div>
                            <div class="col-md-3">Price :</div>
                            <div class="col-md-3">: <span id="price">0.0</span></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Customer Phone</div>
                            <div class="col-md-3"><input class="form-control" type="text" id="customerPhone"></div>
                            <div class="col-md-3">Gross Price (inc <span id="taxInfo"></span>% Tax)</div>
                            <div class="col-md-3"><h3 id="gross_price">0.00</h3></div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="$(this).openCustomerModal();" class="btn btn-primary btn-block waves-effect waves-light">Confirm Order</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Customer Details</h4>
                </div>
                <div class="modal-body">
                    <form id="submitOrderForm">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="userName">Customer Name*</label>
                            <input type="text"  name="name" parsley-trigger="change" required placeholder="Enter name" class="form-control" id="userName">
                        </div>
                        <div class="form-group">
                            <label for="userName">Customer Phone*</label>
                            <input type="text" name="phone" parsley-trigger="change" required placeholder="Enter Phone number" class="form-control" id="phoneNumber">
                        </div>
                        <div class="form-group">
                            <label for="userName">Customer Email*</label>
                            <input type="email" name="email" parsley-trigger="change" required placeholder="Enter email address" class="form-control" id="emilAddress">
                        </div>
                        <div class="form-group">
                            <label for="userName">Customer Address*</label>
                            <input type="text" name="address" parsley-trigger="change" required placeholder="Enter address" class="form-control" id="userAddress">
                        </div>
                        <input type="submit" style="display: none">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="$('#submitOrderForm').submit();" class="btn btn-primary btn-block waves-effect waves-light">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection

@section('js')
    <script>
        $(document).ready(function () {
            var cart = [];
            var index = 0;
            var vat = $("#tax").val();
            $("#taxInfo").text(vat);

            $.fn.productAddToCart = function (productId) {
                $.get('{{url('/api/outlet/id='.$outlet->id.'/product')}}'+'/'+productId,function (data) {
                    console.log(data);
                    $(this).addProductToCart(data);
                });
            }

            // Add product to cart
            $.fn.addProductToCart = function (data) {
                item = {
                    id: data.id,
                    product_name: data.product_name,
                    sku: data.product_sku,
                    price: data.price,
                    quantity: 1
                };

                if ($(this).isExist(item)) {
                    item = cart[index];
                    item.quantity += 1;
                    $(this).renderTable(cart);
                } else {
                    cart.push(item);
                    $(this).renderTable(cart)
                }
            }


            // increase carted product quantity if exist
            $.fn.isExist = function (data) {
                var toReturn = false;
                $.each(cart, function (index, value) {
                    if (value.id == data.id) {
                        $(this).setIndex(index);
                        toReturn = true;
                    }
                });
                return toReturn;
            }

            // Set cart index
            $.fn.setIndex = function (value) {
                index = value;
            }

            // Render cart table
            $.fn.renderTable = function (cartList) {
                $('#cartTable > tbody').empty();
                $(this).calculateCart();
                $.each(cartList, function (index, data) {
                    $('#cartTable > tbody').append(
                        $('<tr>').append(
                            $('<td>', {text: index + 1}),
                            $('<td>', {text: data.product_name}),
                            $('<td>').append(
                                $('<div>', {class: 'input-group'}).append(
                                    $('<div>', {class: 'input-group-btn btn-xs'}).append(
                                        $('<button>', {
                                            class: 'btn btn-default btn-xs',
                                            onclick: '$(this).qtDecrement(' + index + ')'
                                        }).append(
                                            $('<i>', {class: 'fa fa-minus'})
                                        )
                                    ),
                                    $('<input>', {
                                        class: 'form-control',
                                        type: 'number',
                                        value: data.quantity,
                                        onInput: '$(this).qtInput(' + index + ')'
                                    }),
                                    $('<div>', {class: 'input-group-btn btn-xs'}).append(
                                        $('<button>', {
                                            class: 'btn btn-default btn-xs',
                                            onclick: '$(this).qtIncrement(' + index + ')'
                                        }).append(
                                            $('<i>', {class: 'fa fa-plus'})
                                        )
                                    )
                                )
                            ),
                            $('<td>', {text: data.price * data.quantity}),
                            $('<td>').append(
                                $('<button>', {
                                    class: 'btn btn-danger btn-xs',
                                    onclick: '$(this).deleteFromCart(' + index + ')'
                                }).append(
                                    $('<i>', {class: 'fa fa-times'})
                                )
                            )
                        )
                    )
                })
            };

            //Calculate cart value
            $.fn.calculateCart = function () {
                var total = 0;
                $('#total').text(cart.length);
                $("#cartItems").text(cart.length);
                $.each(cart, function (index, data) {
                    total += data.quantity * data.price;
                })
                $('#price').text(total);
                if ($("#inputDiscount").val() >= total) {
                    $("#inputDiscount").val(0);
                }
                var totalVat = ((total * vat) / 100);
                var grossTotal = ((total + totalVat).toFixed(2));
                $("#gross_price").text(grossTotal);
                $("#payablePrice").val(grossTotal);
            };

            // Delete product from cart
            $.fn.deleteFromCart = function (index) {

                cart.splice(index, 1);
                console.log(cart);
                $(this).renderTable(cart);

            }

            // Increase quantity of selected product
            $.fn.qtIncrement = function (i) {
                item = cart[i];
                item.quantity += 1;
                $(this).renderTable(cart);
            }

            // Decrement quantity of selected product
            $.fn.qtDecrement = function (i) {
                if (item.quantity > 1) {
                    item = cart[i];
                    item.quantity -= 1;
                    $(this).renderTable(cart);
                }
            }

            // Get quantity input
            $.fn.qtInput = function (i) {
                item = cart[i];
                item.quantity = $(this).val();
                $(this).renderTable(cart);
            }
            
            $.fn.openCustomerModal = function () {
                $(".bs-example-modal-lg").modal('toggle');
                $(".bs-example-modal-sm").modal('toggle');
            }
            
            $("#submitOrderForm").on('submit',function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url:'{{url('/outlet/id='.$outlet->id.'/save-customer')}}',
                    type:'post',
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success:function(data){
                        $(this).saveOrder(data);
                        console.log(data);
                    },error:function (data) {
                        
                    }
                })
                
            });
            
            $.fn.saveOrder = function (data) {
                var data = {
                    _token: $("input[name=_token]").val(),
                    ref_number: '',
                    discount: 0,
                    customer_id: data.id,
                    status : 0,
                    tax: vat,
                    order_type : 2,
                    products: cart
                }
                $.ajax({
                    url: '{{url('/outlet/id='.$outlet->id.'/save-customer-order')}}',
                    type: 'POST',
                    data: JSON.stringify(data),
                    contentType: 'application/json; charset=utf-8',
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $(".loading").hide();
                        $(".bs-example-modal-sm").modal('toggle');
                        cart = [];
                        $(this).renderTable(cart);
                        $(this).calculateCart();
                        swal({
                                title: "Print receipt?",
                                text: "Click ok if you want to print receipt!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: 'btn-primary btn-md waves-effect waves-light',
                                confirmButtonText: 'Close'
                            });

                    }, error: function (data) {
                        $(".loading").hide();
                        $(".bs-example-modal-sm").modal('toggle');
                        swal("Something went wrong!", 'Please refresh this page and try again');

                    }
                });
            }
        })
    </script>
@endsection