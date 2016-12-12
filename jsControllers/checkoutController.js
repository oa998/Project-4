$(function(){
    $.ajax({
        type: 'post',
        url:  '../models/checkoutPreSaleModel.php',  //get the form for cc info
        data: {},

        success: function (response) {
            $('#results_here').html(response+"<script src=\"../jsControllers/creditCard.js\"></script>");
        }
    });

});

function checkCode(code_txt_id){
    if($("#"+code_txt_id).val()=="") 
        return;
    var wait_millis = 600;
    $("#"+code_txt_id).val("verifying");
        
    setTimeout(function(){
        $("#"+code_txt_id).val("verifying.");
    }, wait_millis);
    setTimeout(function(){
        $("#"+code_txt_id).val("verifying..");
    }, wait_millis*2);
    setTimeout(function(){
        $("#"+code_txt_id).val("verifying...");
    }, wait_millis*3);
    setTimeout(function(){
        $("#"+code_txt_id).val("verifying....");
    }, wait_millis*4);
    setTimeout(function(){
        $("#"+code_txt_id).val("I'm sorry, code invalid");
    }, wait_millis*5);
    setTimeout(function(){
        $("#"+code_txt_id).val("");
        $("#"+code_txt_id).attr("placeholder"," Input Discount Code");
    }, wait_millis*10);
}

