$(function(){
    $.ajax({
        type: 'post',
        url:  '../models/salesModel.php',
        data: {},

        success: function (response) {
            $('#results_here').html(response);
        }
    });

})