
//on page load set initial result set
$(function(){
    var x = 0;
    var y = 0;
    setInterval(function(){
        x-=1;
        y-=1;
        if(y==-3490) {x=0; y=0;}
        $('#headDiv').css('background-position', x +'px '+ y + 'px');
    }, 30);
    
    $("#search_terms").keyup(function(event){
        if(event.keyCode == 13){
            $("#search_button").trigger('click');
        }
    });
        
    $("#password_text").keyup(function(event){
        if(event.keyCode == 13){
            $("#log_in_button").trigger('click');
        }
    });
        
    

})

//the "dropdown" menu effect for the "Product Categories" option
function slideProducts(){
  $("#toggleCategories").slideToggle("slow");
}

//Search the inventory for keyword(s)
function searchTerms(keywords) {
    if(!window.location['pathname'].includes('homepage')){
        window.location.assign("/homepage.php?"+keywords);
    }
	keywords = keywords.trim();
	if(keywords!="")
	{
        $.ajax({
            type: 'post',
            url:  '../models/displaySearchItems.php',
            data: {
              keyword : keywords,
            },

            success: function (response) {
              $('#results_here').html(response);
            }
        });

        $("#toggleCategories").slideUp("slow");

	} else {

	  $( '#results_here' ).html("<h2> &nbsp&nbsp Invalid search terms.</h2>");  //if empty string or still "search keyword"

	}

}

//Search button will perform a search using the contents of the search bar
function searchButton(container_id) {
	var search_terms = $("#"+container_id).val().trim();
    searchTerms(search_terms);
}

function logIn() {
	var usernameInput = $("input[name='user_name']").val().trim();
	var passwordInput = $("input[name='pass_word']").val();
	if(usernameInput!="")
	{

		$.ajax({
	    type: 'post',
	    url:  '../models/logInModel.php',
	    data: {
	      username : usernameInput,
	      password : passwordInput
	    },

	    success: function (response) {
          if(!response.includes('background-color: red')){
            location.reload(true);
          }else{
              $('#login_div').html(response);
              $("#password_text").keyup(function(event){
                if(event.keyCode == 13){
                    $("#log_in_button").trigger('click');
                }
              });
              }
            }
          });

	} else {

	  $( "input[name='user_name']" ).css("background-color","darkred");  //if empty string 
	}
}

function logOut(){
	$.ajax({
    type: 'post',
    url:  '../models/logOutModel.php',
    data: {},

    success: function (response) {
      history.pushState(null, document.title, location.pathname);
      window.location.href = "/homepage.php";
	    }
	});
}

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

function showAdmin(){
    window.location.assign("/phpFrame/admin.php");
}

function showCart(){
    window.location.assign("/phpFrame/cart.php");
}

function showPopular(){
    window.location.assign("/phpFrame/popular.php");
}

function showCheap(){
    window.location.assign("/phpFrame/sales.php");
}

function checkout(){
    window.location.assign("/phpFrame/checkout.php");
}