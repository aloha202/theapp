 $('head').append("<link rel='stylesheet' type='text/css' href='" + CORE_CSS_JQUERY_UI + "' >");
 $('head').append("<link rel='stylesheet' type='text/css' href='" + CORE_CSS_THEAPP + "' >");


 $('body').append(("<div class='TheApp_favelet_core'><div class='TheApp_window'><div class='TheApp_handle'>%appName%<div class='TheApp_minimize'>_</div></div><div class='TheApp_content'></div></div></div>")
     .replace('%appName%', DATA.APP_NAME));
 $('.TheApp_favelet_core').append(("<div class='TheApp_token'><div><span>%appName%</span></div></div>")
     .replace('%appName%', DATA.APP_NAME));

 $( ".TheApp_favelet_core .TheApp_window" ).draggable({ handle: ".TheApp_handle" });

 $(".TheApp_token").click(function(){
     $( ".TheApp_favelet_core .TheApp_window" ).animate({
         left: 100,
         top: $(window).scrollTop() + 100
     }, 500);
     $(".TheApp_token").animate({left: -250}, 500);
 });


 $(".TheApp_token").css('width', 200);// must be set here because the css file is not loaded yet
 var tokenLeft = -($(".TheApp_token").width() - $(".TheApp_token span").width() - 10);
 $(".TheApp_token").css('left', tokenLeft);

 $( ".TheApp_favelet_core .TheApp_window .TheApp_minimize" ).click(function(){
     $( ".TheApp_favelet_core .TheApp_window" ).animate({
         left: -500,
         top: -500
     }, 500);
     $(".TheApp_token").animate({left: tokenLeft}, 500);
 });

 var $content = $( ".TheApp_favelet_core .TheApp_window .TheApp_content" );


 if(AUTHORIZED){
     $content.append("<div>" + HTML.APP_CONTENT + "</div>");
 }else{
     $content.append(HTML.NOT_AUTHORIZED);
 }