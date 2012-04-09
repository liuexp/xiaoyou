$(function(){
  $('img').each(function(index){
    $(this).error(function(){
      $(this).hide();
    });
    $(this).attr('src', $(this).attr('src'));
  });
});