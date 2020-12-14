var cart = [];
var index = 0;
var item;
var outlet_id = 0;
var holdOrder = 0;
var vat = 0;
var paymentType = 0;

$(document).ready(function () {
    vat = $('#outlet_tax').val();
    outlet_id = $("#outlet_id").val();
    $("#taxInfo").text(vat);
    $(".loading").hide();
    // Add to cart from product table
    $.fn.addToCart = function (id) {
        $.get('/api/outlet/id=' + outlet_id + '/product/' + id, function (data) {
            $(this).addProductToCart(data);
        });
    };
    // Add to cart form product table by product sku
    $("#searchBarCode").on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#basic-addon2").empty();
        $("#basic-addon2").append(
            $('<i>', {class: 'fa fa-spinner fa-spin'})
        );
        $.ajax({
            url: '/api/outlet/id=' + outlet_id + '/product-sku',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $(this).addProductToCart(data);
                $("#searchBarCode").get(0).reset();
                $("#basic-addon2").empty();
                $("#basic-addon2").append(
                    $('<i>', {class: 'glyphicon glyphicon-ok'})
                )
            }, error: function (data) {
                if (data.status === 422) {
                    $(this).showValidationError(data);
                    $("#basic-addon2").append(
                        $('<i>', {class: 'glyphicon glyphicon-remove'})
                    )
                }
                else if (data.status === 404) {
                    $("#basic-addon2").empty();
                    $("#basic-addon2").append(
                        $('<i>', {class: 'glyphicon glyphicon-remove'})
                    )
                }
                else {
                    $(this).showServerError();
                    $("#basic-addon2").empty();
                    $("#basic-addon2").append(
                        $('<i>', {class: 'glyphicon glyphicon-warning-sign'})
                    )
                }
            }
        });
    });

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

    //Calculate cart value
    $.fn.calculateCart = function () {
        var total = 0;
        $('#total').text(cart.length);
        $.each(cart, function (index, data) {
            total += data.quantity * data.price;
        });
        total = total - $("#inputDiscount").val();
        $('#price').text(total);
        if ($("#inputDiscount").val() >= total) {
            $("#inputDiscount").val(0);
        }
        var totalVat = ((total * vat) / 100);
        var grossTotal = ((total + totalVat)).toFixed(2);
        $("#gross_price").text(grossTotal);
        $("#payablePrice").val(grossTotal);
    };

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

    // cancel order
    $.fn.cancelOrder = function () {
        swal({
                title: "Cancel order?",
                text: "It will clear the cart. Are you sure to cancel this order!",
                type: "info",
                showCancelButton: true,
                cancelButtonClass: 'btn-success btn-md waves-effect',
                cancelButtonText: 'Close',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                confirmButtonText: 'Yes ! plz'
            },
            function (isConfirm) {
                if (isConfirm) {
                    cart = [];
                    $(this).renderTable(cart);
                    holdOrder = 0;
                }
            });
    }

    $("#payButton").on('click', function () {
        if(cart.length != 0){
            $("#paymentModel").modal('toggle');
        }else {
            alert('There is noting to pay');
        }

    })

    $("#hold").on('click', function () {
        if (cart.length != 0) {
            $("#dueModal").modal('toggle');
        } else {
            alert('There is noting to hold');
        }
    })

    $.fn.submitDueOrder = function (status) {
        $(".loading").show();

        var data = {
            sell_order: holdOrder,
            _token: $("input[name=_token]").val(),
            ref_number: $("#refNumber").val(),
            discount: $("#inputDiscount").val(),
            customer_id: $("#customer").val(),
            status: status,
            tax: vat,
            order_type: 1,
            products: cart,
            payment_type: paymentType,
            payment_info: $("#paymentInfo").val(),
            cash_journal: $("#payment").val(),
            change: $("#change").text()
        }

        $.ajax({
            url: '/outlet/id=' + outlet_id + '/save-due-order',
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json; charset=utf-8',
            cache: false,
            processData: false,
            success: function (data) {
                $(".loading").hide();
                $("#dueModal").modal('hide');
                $("#paymentModel").modal('hide');
                $(this).getHoldOrders();
                cart = [];
                $(this).renderTable(cart);
                $(this).getHoldOrders();
                $(this).getCustomerOrders();
                swal({
                        title: "Print receipt?",
                        text: "Click ok if you want to print receipt!",
                        type: "info",
                        showCancelButton: true,
                        cancelButtonClass: 'btn-white btn-md waves-effect',
                        confirmButtonClass: 'btn-primary btn-md waves-effect waves-light',
                        confirmButtonText: 'Print'
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            window.location.replace('/outlet/id=' + outlet_id + '/print/order=' + data.id)
                        }
                    });

            }, error: function (data) {
                $(".loading").hide();
                $("#dueModal").modal('toggle');
                swal("Something went wrong!", 'Please refresh this page and try again');

            }
        });


    }
})