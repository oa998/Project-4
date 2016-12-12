String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};

$(function(){
    
    /*
    If visiting the homepage directly, load the default terms.
    If visiting the homepage via redirection from other pages of
    the website, use the search parameters to populate the page.
    */
    if(window.location['search']==""){
        searchTerms("funny skel");
    }else{
        terms = window.location['search'].substr(1).replaceAll("%20", " ");
        searchTerms(terms);
    }
})

function insertIntoCart(user_name, item_id, button){
    if($("#login_div button").last().html()=="Log In"){
        setTimeout(function(){
            $(button).css("background-color","#90EE90");
            $(button).mouseover(function(){
                $(button).css("background-color","#00b200");
            })
            $(button).mouseleave(function(){
                $(button).css("background-color","#90EE90");
            })
        },500);
        $(button).css("background-color","lightgray");  
    } else {
        $.ajax({
            type: 'post',
            url:  '../models/insertIntoCartModel.php',
            data: {
                username: user_name,
                item: item_id,
            },

            success: function () {
                $(button).css({ 
                    "background-image": "url(http://www.clipartbest.com/cliparts/9iz/Ekb/9izEkbrdT.png)" 
                });
                setTimeout(function(){
                    $(button).css("background-color","#90EE90");
                    $(button).mouseover(function(){
                        $(button).css("background-color","#00b200");
                    })
                    $(button).mouseleave(function(){
                        $(button).css("background-color","#90EE90");
                    })
                },1000);
            }
        });
    }
}
