$(function(){
  var $jcropTarget = $('#jcrop_target');
  var $jcropPreview = $('#jcrop_preview');
  
	function updateCoords(c) {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };
  
  function showPreview(coords) {
    if (parseInt(coords.w) > 0) {
      var rx = 160 / coords.w;
      var ry = 160 / coords.h;
      
      updateCoords(coords);
      
      $jcropPreview.css({
        width: Math.round(rx * $jcropTarget.width()) + 'px',
        height: Math.round(ry * $jcropTarget.height()) + 'px',
        marginLeft: '-' + Math.round(rx * coords.x) + 'px',
        marginTop: '-' + Math.round(ry * coords.y) + 'px'
      }).show();
    }
  }
  
  function hidePreview() {
    $jcropPreview.stop().fadeOut('fast');
  }
  
  $jcropTarget.Jcrop({
    onChange: showPreview,
    onSelect: showPreview,
    onRelease: hidePreview,
    aspectRatio: 1
  });
  
  $('#edit-avatar-form').submit(function(){
    $('.failure').hide();
    // TODO lock screen
    $.ajax({
      type: 'POST', // fuck slim cannot use PUT
      url: window.siteBase + '/avatar/update',
      data: $('#edit-avatar-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location = window.siteBase + '/profile/' + window.profileId;
        } else if (data.message) {
          $('.failure').html(data.message).show();
        } else {
          $('.failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('.failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
});