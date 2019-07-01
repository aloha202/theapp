 $('head').append("<link rel='stylesheet' type='text/css' href='" + CORE_CSS_JQUERY_UI + "' >");
 $('head').append("<link rel='stylesheet' type='text/css' href='" + CORE_CSS_THEAPP + "' >");


 $('body').append("<div class='TheApp_favelet_core'><div class='TheApp_window'><div class='TheApp_handle'>TheApp</div></div></div>");

 $( ".TheApp_favelet_core .TheApp_window" ).draggable({ handle: ".TheApp_handle" });
 setTimeout(function(){
     $( ".TheApp_favelet_core .TheApp_window" ).animate({
         left: 100,
         top: 100
     }, 500);
 }, 1000);
