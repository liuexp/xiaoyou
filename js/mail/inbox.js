$(function(){
  $('.tweet').bind('closed', function(){
    //$(this).parent().remove();
    $.ajax(window.siteBase + '/inbox/' + $(this).attr('data-mail-id'), { type: 'DELETE' });
  });
}); 
