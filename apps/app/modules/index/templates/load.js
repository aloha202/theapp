 $('head').append("<link rel='stylesheet' type='text/css' href='" + CORE_CSS_JQUERY_UI + "' >");
 $('head').append("<link rel='stylesheet' type='text/css' href='" + CORE_CSS_THEAPP + "' >");


 $('body').append("<div class='TheApp_favelet_core'><div class='TheApp_window'><div class='TheApp_handle'>TheApp<div class='TheApp_minimize'>_</div></div></div></div>");
 $('.TheApp_favelet_core').append("<div class='TheApp_token'><div>TheApp</div></div>")

 $( ".TheApp_favelet_core .TheApp_window" ).draggable({ handle: ".TheApp_handle" });

 $(".TheApp_token").click(function(){
     $( ".TheApp_favelet_core .TheApp_window" ).animate({
         left: 100,
         top: $(window).scrollTop() + 100
     }, 500);
     $(".TheApp_token").animate({left: -250}, 500);
 });

 $( ".TheApp_favelet_core .TheApp_window .TheApp_minimize" ).click(function(){
     $( ".TheApp_favelet_core .TheApp_window" ).animate({
         left: -500,
         top: -500
     }, 500);
     $(".TheApp_token").animate({left: -140}, 500);
 });