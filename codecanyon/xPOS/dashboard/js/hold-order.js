var holdOrderList = [];

$(document).ready(function () {
    var totalPrice = 0;
    var holdOrderlocation = $("#randerHoldOrders");
    var dotInterval =  setInterval(function(){ $(".dot").text('.') }, 3000);

    $.get('/api/outlet/id=' + outlet_id + '/hold-orders', function (data) {
        console.log(data);
        holdOrderList = data;
        holdOrderlocation.empty();
        clearInterval(dotInterval);
        $(this).randerHoldOrders(holdOrderList,holdOrderlocation,1);
    });


    $.fn.getHoldOrders = function () {
        $.get('/api/outlet/id=' + outlet_id + '/hold-orders', function (data) {
            console.log(data);
            holdOrderList = data;
            clearInterval(dotInterval);
            $(this).randerHoldOrders(holdOrderList,holdOrderlocation,1);
        });
    };

    $.fn.randerHoldOrders = function (data,renderLocation,orderType) {
        $.each(data, function (index, order) {
            $(this).calculatePrice(order);
            renderLocation.append(
                $('<div>', {class: orderType == 1 ? 'col-md-3 order' : 'col-md-3 customer-order'}).append(
                    $('<a>', {href: 'javascript:void(0)', onclick: '$(this).orderDetails(' + index +','+orderType+  ')'}).append(
                        $('<div>', {class: 'card-box order-box'}).append(
                            $('<p>').append(
                                $('<b>', {text: 'Ref :'}),
                                $('<span>', {text: order.ref_number,class:'ref_number'}),
                                $('<br>'),
                                $('<b>', {text: 'Price :'}),
                                $('<span>', {text: totalPrice, class: "label label-default", style: 'font-size:14px;'}),
                                $('<br>'),
                                $('<b>', {text: 'Items :'}),
                                $('<span>', {text: order.products.length}),
                                $('<br>'),
                                $('<b>', {text: 'Customer :'}),
                                $('<span>', {text: order.customer != null ? order.customer.name : 'Walk in customer',class:'customer_name'})
                            ),
                            $('<button>', {class: 'btn btn-danger',onclick:'$(this).deleteOrder('+index+')'}).append(
                                $('<i>', {class: 'fa fa-trash'})
                            ),
                            $('<a>', {class: 'btn btn-success',href:'/outlet/id='+outlet_id+'/print/order='+order.id, target:'_blank'}).append(
                                $('<i>', {class: 'fa fa-print'})
                            ),
                            $('<button>',{class:'btn btn-info'}).append(
                                $('<i>',{class: 'fa fa-money'}),
                                $('<span>',{text:' Pay'})
                            )
                        )
                    )
                )
            )
        })
    }

    $.fn.calculatePrice = function (data) {
        totalPrice = 0;
        $.each(data.products, function (index, product) {
            totalPrice += product.price * product.quantity;
        })
        var vat = (totalPrice * data.vat) / 100;
        totalPrice = ((totalPrice + vat) - data.discount).toFixed(0);
        return totalPrice;
    };

    $.fn.orderDetails = function (index,orderType) {
        if(orderType == 1){
            holdOrder = holdOrderList[index].id;
            cart = [];
            $.each(holdOrderList[index].products, function (index, data) {
                item = {
                    id: data.product.id,
                    product_name: data.product.product_name,
                    sku: data.product.product_sku,
                    price: data.price,
                    quantity: data.quantity
                };
                cart.push(item);
            })
        }else if(orderType == 2){
            holdOrder = customerOrderList[index].id;
            cart = [];
            $.each(customerOrderList[index].products, function (index, data) {
                item = {
                    id: data.product.id,
                    product_name: data.product.product_name,
                    sku: data.product.product_sku,
                    price: data.price,
                    quantity: data.quantity
                };
                cart.push(item);
            })
        }
        $(this).renderTable(cart);
        $("#holdOrdersModal").modal('hide');
        $("#customerModal").modal('hide');
    }
    
    $.fn.deleteOrder = function (index) {
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
            if(isConfirm){
                $.get('/api/outlet/id='+outlet_id+'/delete-order/'+holdOrderList[index].id,function (data) {
                    $(this).getHoldOrders();
                })
            }
        });
    }
    
})