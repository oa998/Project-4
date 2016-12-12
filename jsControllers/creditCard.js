var ccEl = document.getElementById("cc_num");
console.log("visa: "+4024007149110024);
console.log("mast: "+5331900620882191);
console.log("amex: "+376866330320185);
console.log("disc: "+6011715135326756);
var form_check = setInterval(function(){
    var num = $(ccEl).val().substr(0,4);
    var fullNum = $(ccEl).val();
    $("#purchase").attr("disabled",true).css("background-color","gray");
    //visa
    if(num.substr(0,1)==4){
        $("#visa").css({
            "-webkit-transform" : "scale(2.5) translateX(-20%)",
            "filter" : "grayscale(0%)"
        })
    }else{
        $("#visa").css({
            "-webkit-transform" : "scale(1) translateX(-50%)",
            "filter" : "grayscale(100%)"
        })
    }

    //master card
    if(Number(num.substr(0,2))<=55 && Number(num.substr(0,2))>=51){
        $("#mast").css({
            "-webkit-transform" : "scale(2.5) translateX(-20%)",
            "filter" : "grayscale(0%)"
        })
    }else{
        $("#mast").css({
            "-webkit-transform" : "scale(1) translateX(-50%)",
            "filter" : "grayscale(100%)"
        })
    }

    //Discover
    if(num.substr(0,2)==65 || num==6011){
        $("#disc").css({
            "-webkit-transform" : "scale(2.5) translateX(-20%)",
            "filter" : "grayscale(0%)"
        })
    }else{
        $("#disc").css({
            "-webkit-transform" : "scale(1) translateX(-50%)",
            "filter" : "grayscale(100%)"
        })
    }

    //AmEx
    if(num.substr(0,2)==34 || num.substr(0,2)==37){
        $("#amex").css({
            "-webkit-transform" : "scale(2.5) translateX(-20%)",
            "filter" : "grayscale(0%)"
        })
    }else{
        $("#amex").css({
            "-webkit-transform" : "scale(1) translateX(-50%)",
            "filter" : "grayscale(100%)"
        })
    }
    
    var valid_cc = false;
    if(valid_credit_card(fullNum) || fullNum.length>=15){
        valid_cc=true;
    }
    
    var all_inputs = $("#sale_options input");
    for(var x = 0; x<all_inputs.length; x++){
        if(x==2 || x==3){continue;}
        if ($(all_inputs[x]).val()==""){
            valid_cc=false;
        }
    }
    
    if(valid_cc){
        $("#purchase").attr("disabled",false).css("background-color","lightgreen").attr("onclick","makePayment()");
    }

},50);

function makePayment(){
    clearInterval(form_check);
    $("#results_here").html(
        "<br><br><img id=\"loading\" src=\"https://media.giphy.com/media/12PfUj30bGF2De/giphy.gif\">"+
        "<div style=\"width:100%; text-align:center; padding-left: 2px;\"><div id=\"progress\"><div id=\"content\">"+
        "</div></div></div>"
        );
    $("#loading").css({
        "position": "relative",
        "height" : "400px"
    });
    
    $("#progress").css({
        "top": "-40px",
        "left": "50%",
	    "transform": "translateX(-50%)",
        "height":"24px",
        "width": "485px",
        "background-color": "lightgray",
        "border":"solid blue 2px"
    })
    
    $("#content").css({
        "height":"20px",
        "width": "0px",
        "border": "solid transparent 2px",
        "background-color": "green"
    })
    
    $("#content").animate({ width: "100%" },3000);
    
    setTimeout(function(){
        $.ajax({
	    type: 'post',
	    url:  '../models/processSaleModel.php',
	    data: {},

	    success: function (response) {
	      $("#results_here").html(response);
        }
      });
        
    },3400);
}

function valid_credit_card(value) {
// accept only digits, dashes or spaces
    if (/[^0-9-\s]+/.test(value)) return false;

// The Luhn Algorithm. It's so pretty.
    var nCheck = 0, nDigit = 0, bEven = false;
    value = value.replace(/\D/g, "");

    for (var n = value.length - 1; n >= 0; n--) {
        var cDigit = value.charAt(n),
            nDigit = parseInt(cDigit, 10);

        if (bEven) {
            if ((nDigit *= 2) > 9) nDigit -= 9;
        }

        nCheck += nDigit;
        bEven = !bEven;
    }

    return (nCheck % 10) == 0;
}