$(function(){
  $('.a-feed .comments').hide();
  $('.a-feed .details .legend .reply').toggle(function(){
    // show comments
    $(this).attr('data-text', $(this).text());
    $(this).text('收起回复');
    $(this).parent().parent().next().show();
    $('#textbox-'+$(this).attr('data-mail-id')).focus();
  }, function(){
    // hide comments
    $(this).text($(this).attr('data-text'));
    $(this).parent().parent().next().hide();
  });
});
