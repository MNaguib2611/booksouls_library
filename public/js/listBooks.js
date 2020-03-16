$(document).ready(function(){

	$('.deletebutton').click(function(){
        //$(this).parent().parent().parent().addClass("deleteme");
        $(this).closest('.book').addClass("deleteme");
        // $(this).delay(50000).addClass("hideme");
    });

});



