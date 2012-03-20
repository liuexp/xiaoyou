$(function(){
  $('#edit-honor-form').submit(function(){
    $('#edit-honor-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST', // fuck slim cannot use PUT
      url: window.siteBase + '/honor/' + window.honorId,
      data: $('#edit-honor-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location.reload();
        } else if (data.message) {
          $('#edit-honor-form .failure').html(data.message).show();
        } else {
          $('#edit-honor-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#edit-honor-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
});