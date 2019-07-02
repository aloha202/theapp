 // $('head').append("<link rel='stylesheet' type='text/css' href='" + CORE_CSS_JQUERY_UI + "' >");
 // $('head').append("<link rel='stylesheet' type='text/css' href='" + CORE_CSS_THEAPP + "' >");


 $('body').append(("<div class='TheApp_favelet_core'><div class='TheApp_window'><div class='TheApp_handle'>%appName%<div class='TheApp_minimize'>_</div></div><div class='TheApp_content'></div></div></div>")
     .replace('%appName%', DATA.APP_NAME));
 $('.TheApp_favelet_core').append(("<div class='TheApp_token'><div><span>%appName%</span></div></div>")
     .replace('%appName%', DATA.APP_NAME));

// styles

 $('.TheApp_favelet_core').css({

 });

 $('.TheApp_favelet_core .TheApp_window').css({
     'position' : 'fixed',
     'width' : '200px',
     'min-height' : '300px',
     'overflow' : 'auto',
     'background' : '#fff',
     'border' : 'solid 1px #0A487C',
     'padding' : '5px',
     'left' : '-500px',
     'top' : '-500px',
     'z-index' : '10000'
 });

 $('.TheApp_favelet_core .TheApp_window .TheApp_handle').css({
     'background' : '#CCC',
     'height' : '20px',
     'position' : 'relative'
 });

 $('.TheApp_favelet_core .TheApp_window .TheApp_handle .TheApp_minimize').css({
     'position' : 'absolute',
     'right' : '4px',
     'bottom' : '2px',
     'font-size' : '16px',
     'cursor' : 'pointer'
 });

 $('.TheApp_favelet_core .TheApp_token').css({
     'position' : 'fixed',
     'width' : '200px',
     'text-align' : 'right',
     'padding' : '3px',
     'background' : '#fff',
     'border' : 'solid 1px #0A487C',
     'top' : '150px',
     'left' : '100px',
     'z-index' : '10000',
     'cursor' : 'pointer'
 });

 $('.TheApp_favelet_core .TheApp_token div').css({
     'background' : '#CCC',
     'padding' : '2px'
 });



  $( ".TheApp_favelet_core .TheApp_window" ).draggable({ handle: ".TheApp_handle" });

 $(".TheApp_token").click(function(){
     $( ".TheApp_favelet_core .TheApp_window" ).animate({
         left: 100,
         top: 100
     }, 500);
     $(".TheApp_token").animate({left: -250}, 500);
 });



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
     if(HTML.APP_CONTENT) {
         $content.append("<div>" + HTML.APP_CONTENT + "</div>");
     }
 }else{
     $content.append(HTML.NOT_AUTHORIZED);
 }