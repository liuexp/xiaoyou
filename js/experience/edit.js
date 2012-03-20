$(function(){
  $('#edit-experience-form').submit(function(){
    $('#edit-experience-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST', // fuck slim cannot use PUT
      url: window.siteBase + '/experience/' + window.experienceId,
      data: $('#edit-experience-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location.reload();
        } else if (data.message) {
          $('#edit-experience-form .failure').html(data.message).show();
        } else {
          $('#edit-experience-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#edit-experience-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
});