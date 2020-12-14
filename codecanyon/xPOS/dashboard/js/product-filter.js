$(document).ready(function(){
    var $btns = $('.btn-categories').click(function() {
        if (this.id == 'all') {
            $('#parent > div').fadeIn(450);
        } else {
            var $el = $('.' + this.id).fadeIn(450);
            $('#parent > div').not($el).hide();
        }
        $btns.removeClass('active');
        $(this).addClass('active');
    })

    var $search = $("#search").on('input',function(){
        console.log('input');
        $btns.removeClass('active');
        var matcher = new RegExp($(this).val(), 'gi');
        $('.box').show().not(function(){
            return matcher.test($(this).find('.name, .sku').text())
        }).hide();
    });

    var $searchHoldOrder = $("#holdOrderInput").on('input',function () {
       console.log('Due order search...');
        var matcher = new RegExp($(this).val(), 'gi');
        $('.order').show().not(function(){
            return matcher.test($(this).find('.ref_number').text())
        }).hide();
    });

    var $searchCustomerOrder = $("#holdCustomerOrderInput").on('input',function () {
        console.log('Customer order search...');
        var matcher = new RegExp($(this).val(), 'gi');
        $('.customer-order').show().not(function(){
            return matcher.test($(this).find('.ref_number','.customer_name').text())
        }).hide();
    })


    var $list = $('.list-group-item').click(function () {
       $list.removeClass('active');
       $(this).addClass('active');
       if(this.id == 'check'){
            $("#cardInfo").show();
            $("#cardInfo .input-group-addon").text("Check Info");
       }else if(this.id == 'card'){
           $("#cardInfo").show();
           $("#cardInfo .input-group-addon").text("Card Info");
       }else if(this.id == 'cash'){
           $("#cardInfo").hide();
       }
    });


    $.fn.go = function (value,isDueInput) {
        if(isDueInput){
            $("#refNumber").val($("#refNumber").val()+""+value)
        }else{
            $("#payment").val($("#payment").val()+""+value);
            $(this).calculateChange();
        }
    }


    $.fn.digits = function(){
        $("#payment").val($("#payment").val()+".");
        $(this).calculateChange();
    }

    $.fn.calculateChange = function () {
        var change = $("#payablePrice").val() - $("#payment").val();
        if(change <= 0){
            $("#change").text(change.toFixed(2));
        }else{
            $("#change").text('Nothing to change')
        }
        if(change <= 0){
            $("#confirmPayment").show();
        }else{
            $("#confirmPayment").hide();
        }
    }


})