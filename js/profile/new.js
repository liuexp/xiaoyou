$(function(){
  $('#new-profile').submit(function(){
    $('#new-profile .failure').hide();
    // TODO client-side validaton
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/profiles',
      data: $('#new-profile').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location = window.siteBase + '/profile/' + data.profile_id;
        } else if (data.message) {
          $('#new-profile .failure').html(data.message).show();
        } else {
          $('#new-profile .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#new-profile .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
});