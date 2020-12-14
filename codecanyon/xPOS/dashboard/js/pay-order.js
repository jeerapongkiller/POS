$(document).ready(function () {
    $("#confirmPayment").hide();
    $("#cardInfo").hide();
    
    $("#payment").on('input',function () {
        $(this).calculateChange();
    });

    $("#confirmPayment").on('click',function () {
        $(this).submitDueOrder(1);
    })
});