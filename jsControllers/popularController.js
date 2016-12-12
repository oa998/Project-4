$(function(){
    $.ajax({
        type: 'post',
        url:  '../models/popularModel.php',
        data: {},

        success: function (response) {
            $('#results_here').html(response);
        }
    });

})