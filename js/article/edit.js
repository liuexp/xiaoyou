$(function(){
  $('#edit-article-form').submit(function(){
    $('#edit-article-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/article/' + window.articleId,
      data: $('#edit-article-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location.reload();
        } else if (data.message) {
          $('#edit-article-form .failure').html(data.message).show();
        } else {
          $('#edit-article-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#edit-article-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
});