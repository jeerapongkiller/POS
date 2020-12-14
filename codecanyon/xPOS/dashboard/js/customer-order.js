
var customerOrderList = [];

$(document).ready(function () {

    var customerOrderLocation = $("#randerCustomerOrders");
    var dotInterval =  setInterval(function(){ $(".dot").text('.') }, 3000);

    $.fn.getCustomerOrders = function () {
        $.get('/api/outlet/id=' + outlet_id + '/customer-orders', function (data) {
            console.log(data);
            clearInterval(dotInterval);
            customerOrderList = data;
            customerOrderLocation.empty();
            $(this).randerHoldOrders(customerOrderList, customerOrderLocation,2);
        });
    }

    $('#saveCustomer').on('submit',function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '/outlet/id='+outlet_id+'/save-customer',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success:function (data) {
                $("#newCustomer").modal('hide');
                swal("Customer added!", "Customer added successfully!", "success");
                $('#customer').append(
                    $('<option>',{text:data.name,value:data.id,selected:'selected'})
                )
            },error:function (data) {
                $("#newCustomer").modal('hide');
                swal('Error','Something went wrong please try again','error')
            }
        })
    })

})