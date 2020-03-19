$(document).ready(function(){
    $(function() {
      $( "#slider-range-min" ).slider({
        range: "min",
        value: 5,
        min: 0,
        max: 10,
        slide: function( event, ui ) {
          $( "#days" ).val(ui.value+" Days");
          $( "#daysForm" ).val(ui.value);
          $( "#amount" ).val( "$" + (ui.value*price));
          $(".a, .b, .c, .d").width((ui.value*10) + "%");
        }
      });
      $(".ui-slider-handle").text("<>");
      $( "#days" ).val($( "#slider-range-min" ).slider( "value")+" Days");
      $( "#daysForm" ).val($( "#slider-range-min" ).slider( "value"));
      $( "#amount" ).val( "$" + $( "#slider-range-min" ).slider( "value")*price);
    });
  
  
  });
  
  