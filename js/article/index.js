$(function(){
  $('.article-link').fancybox({'centerOnScroll': true});
  $('.fancy-link').fancybox({'hideOnOverlayClick': false});
  $('#new-article-form').submit(function(){
    $('#new-article-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/articles',
      data: $('#new-article-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location.reload();
        } else if (data.message) {
          $('#new-article-form .failure').html(data.message).show();
        } else {
          $('#new-article-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#new-article-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
});