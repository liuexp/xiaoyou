$(function(){
  $('#edit-paper-form').submit(function(){
    $('#edit-paper-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST', // fuck slim cannot use PUT
      url: window.siteBase + '/paper/' + window.paperId,
      data: $('#edit-paper-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location.reload();
        } else if (data.message) {
          $('#edit-paper-form .failure').html(data.message).show();
        } else {
          $('#edit-paper-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#edit-paper-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
});