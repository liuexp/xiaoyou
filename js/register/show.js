$(function(){
  $('#register').submit(function(){
    // TODO client-side validaton
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/register',
      data: $('#register').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location = window.siteBase + '/profiles/new';
        } else if (data.message) {
          $('#register .failure').html(data.message).show();
        } else {
          $('#register .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#register .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
});