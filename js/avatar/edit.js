$(function(){
  var $jcropTarget = $('#jcrop_target');
  var $jcropPreview = $('#jcrop_preview');
  
  function showPreview(coords) {
    if (parseInt(coords.w) > 0) {
      var rx = 160 / coords.w;
      var ry = 160 / coords.h;
      
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
});