
$(document).ready(function(){

    $('.deletebutton').click(function(e){
          e.preventDefault();
          //$(this).parent().parent().parent().addClass("deleteme");
          $(this).closest('.book').addClass("deleteme");
          // $(this).delay(50000).addClass("hideme");
      });
    
    });
    
    