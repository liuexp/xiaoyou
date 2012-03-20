$(function(){
  $('#invite').submit(function(){
    $('#invite .success').hide();
    $('#invite .failure').hide();
    // TODO client-side validaton
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/invite',
      data: $('#invite').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          $('#invite .success').html('邀请成功！我们会定期给他们发送邀请邮件，提醒他们加入进来。谢谢您的支持！').show();
        } else if (data.message) {
          $('#invite .failure').html(data.message).show();
        } else {
          $('#invite .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#invite .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
});