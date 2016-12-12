$(function(){
    $.ajax({
        type: 'post',
        url:  '../models/cartModel.php',
        data: {},

        success: function (response) {
            $('#results_here').html(response);
            if($("#item_count").html().trim()==0){
                $("#to_checkout").attr("disabled",true).css("color","gray");
            }
        }
    });

})


function increaseOrder(user_name, item_id){
    stock_available = Number($("#stock"+item_id).html());
    number_in_cart = Number($("#cart"+item_id).html());
    if(number_in_cart==stock_available){
        return;
    }
    $.ajax({
        type: 'post',
        url:  '../models/modifyCartDetailsModel.php',
        data: {
            username: user_name,
            item: item_id,
            change: 1
        },

        success: function () {
            $('#cart'+item_id).html(number_in_cart+1);
        }
    });
}

function reduceOrder(user_name, item_id){
    stock_available = Number($("#stock"+item_id).html());
    number_in_cart = Number($("#cart"+item_id).html());
    if(number_in_cart<=0){
        return;
    }
    $.ajax({
        type: 'post',
        url:  '../models/modifyCartDetailsModel.php',
        data: {
            username: user_name,
            item: item_id,
            change: -1
        },

        success: function () {
            $('#cart'+item_id).html(number_in_cart-1);
        }
    });
}
