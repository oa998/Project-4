$(function(){
    $.ajax({
        type: 'post',
        url:  '../models/adminModel.php',
        data: {},

        success: function (response) {
            $('#results_here').css("padding-left","100px");
            $('#results_here').html(response);
        }
    });

})

///////////////////////////////INVENTORY table

function modifyInventoryItem(itemID_input, itemName_input, itemPrice_input, itemStock_input, itemKeywords_input, itemImage_input, button){
    var item_id         = $("#"+itemID_input).val();
    var item_name       = $("#"+itemName_input).val();
    var item_price      = $("#"+itemPrice_input).val();
    var item_stock      = $("#"+itemStock_input).val();
    var item_keywords   = $("#"+itemKeywords_input).val();
    var item_image      = $("#"+itemImage_input).val();
    
    $.ajax({
        type: 'post',
        url:  '../models/modifyInventoryModel.php',
        data: {
            itemID: item_id,
            itemName: item_name,
            itemPrice: item_price,
            itemStock: item_stock,
            itemKeywords: item_keywords,
            itemImage: item_image
        },

        success: function (response) {
            var old_bg_color = $(button).css("background-color");
            var old_tx_color = $(button).css("color");
            var msg_bg_color = "green";
            var msg_tx_color  = "yellow";
            if(response==""){
                response="Failure";
                msg_bg_color = "red";
            }
            setTimeout(function(){                
                $(button).html("Save Changes");
                $(button).css({
                    "background-color" : old_bg_color,
                    "color" : old_tx_color,
                    "width" : "100%"                    
                });
                $(button).attr("disabled",false);
            },3000);
            $(button).html(response);
            $(button).css({
                "background-color" : msg_bg_color,
                "color" : msg_tx_color,
                "width" : "100%"
            });
            $(button).attr("disabled",true);
        }
    });    
}

function deleteFromInventory(itemID_input, button){
    var item_id         = $("#"+itemID_input).val();
    $.ajax({
        type: 'post',
        url:  '../models/deleteFromInventoryModel.php',
        data: {
            itemID: item_id
        },

        success: function (response) {
            var old_tx_color = $(button).css("color");
            var msg_bg_color = "green";
            var msg_tx_color  = "yellow";
            if(response==""){
                response="Error";
                msg_bg_color = "red";
            }            
            setTimeout(function(){
                $(button).css({
                    "background-color" : "transparent",
                    "color" : old_tx_color,
                    "width" : "100%"                    
                });
            },3000);
            $(button).html(response);
            $(button).css({
                "background-color" : msg_bg_color,
                "color" : msg_tx_color,
                "width" : "100%"
            });
            $(button).attr("disabled",true);
        }
    });
    
}

function createInventoryItem(itemID_input, itemName_input, itemPrice_input, itemStock_input, itemKeywords_input, itemImage_input, button){
    var item_id         = $("#"+itemID_input).val();
    var item_name       = $("#"+itemName_input).val();
    var item_price      = $("#"+itemPrice_input).val();
    var item_stock      = $("#"+itemStock_input).val();
    var item_keywords   = $("#"+itemKeywords_input).val();
    var item_image      = $("#"+itemImage_input).val();
    
    $.ajax({
        type: 'post',
        url:  '../models/insertIntoInventoryModel.php',
        data: {
            itemID: item_id,
            itemName: item_name,
            itemPrice: item_price,
            itemStock: item_stock,
            itemKeywords: item_keywords,
            itemImage: item_image
        },

        success: function (response) {
            var old_bg_color = $(button).css("background-color");
            var old_tx_color = $(button).css("color");
            var msg_bg_color = "green";
            var msg_tx_color  = "yellow";
            if(response==""){
                response="Failure";
                msg_bg_color = "red";
            }            
            setTimeout(function(){ 
                if(response=="Failure"){
                    $(button).html("Create Item");
                        $(button).css({
                        "background-color" : old_bg_color,
                        "color" : old_tx_color,
                        "width" : "100%"                    
                    });
                    $(button).attr("disabled",false);
                }
            },3000);
            $(button).html(response);
            $(button).css({
                "background-color" : msg_bg_color,
                "color" : msg_tx_color,
                "width" : "100%"
            });
            $(button).attr("disabled",true);
        }
    });
    
}

////////////////////////////////////USERS table

function modifyUser(username_input, password_input, level_input, button){
    var username    = $("#"+username_input).val();
    var password    = $("#"+password_input).val();
    var level       = $("#"+level_input).val();
    
    $.ajax({
        type: 'post',
        url:  '../models/modifyUserModel.php',
        data: {
            user_name: username,
            pass_word: password,
            access_lvl: level
        },

        success: function (response) {
            var old_bg_color = $(button).css("background-color");
            var old_tx_color = $(button).css("color");
            var msg_bg_color = "green";
            var msg_tx_color  = "yellow";
            if(response==""){
                response="Failure";
                msg_bg_color = "red";
            }            
            setTimeout(function(){                
                $(button).html("Save Changes");
                $(button).css({
                    "background-color" : old_bg_color,
                    "color" : old_tx_color,
                    "width" : "100%"                    
                });
                $(button).attr("disabled",false);
            },3000);
            $(button).html(response);
            $(button).css({
                "background-color" : msg_bg_color,
                "color" : msg_tx_color,
                "width" : "100%"
            });
            $(button).attr("disabled",true);
        }
    });
}

function deleteUser(username_input, button){
    var username    = $("#"+username_input).val();
    $.ajax({
        type: 'post',
        url:  '../models/deleteUserModel.php',
        data: {
            user_name: username
        },

        success: function (response) {
            console.log(response);
            var old_tx_color = $(button).css("color");
            var msg_bg_color = "green";
            var msg_tx_color  = "yellow";
            if(response==""){
                response="Error";
                msg_bg_color = "red";
            }            
            setTimeout(function(){
                $(button).css({
                    "background-color" : "transparent",
                    "color" : old_tx_color,
                    "width" : "100%"                    
                });
            },3000);
            $(button).html(response);
            $(button).css({
                "background-color" : msg_bg_color,
                "color" : msg_tx_color,
                "width" : "100%"
            });
            $(button).attr("disabled",true);
        }
    });
}

function createUser(username_input, password_input, level_input, button){
    var username    = $("#"+username_input).val();
    var password    = $("#"+password_input).val();
    var level       = $("#"+level_input).val();
    
    $.ajax({
        type: 'post',
        url:  '../models/insertIntoUserModel.php',
        data: {
            user_name: username,
            pass_word: password,
            access_lvl: level
        },

        success: function (response) {
            var old_bg_color = $(button).css("background-color");
            var old_tx_color = $(button).css("color");
            var msg_bg_color = "green";
            var msg_tx_color  = "yellow";
            if(response==""){
                response="Failure";
                msg_bg_color = "red";
            }            
            setTimeout(function(){ 
                if(response=="Failure"){
                    $(button).html("Create Item");
                        $(button).css({
                        "background-color" : old_bg_color,
                        "color" : old_tx_color,
                        "width" : "100%"                    
                    });
                    $(button).attr("disabled",false);
                }
            },3000);
            $(button).html(response);
            $(button).css({
                "background-color" : msg_bg_color,
                "color" : msg_tx_color,
                "width" : "100%"
            });
            $(button).attr("disabled",true);
        }
    });
}






























