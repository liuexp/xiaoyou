$(function(){
  var $jcropTarget = $('#jcrop_target');
  var $targetWidth, $targetHeight;
  var $jcropPreview = $('#jcrop_preview');
  
  $('<img/>').attr('src', $jcropTarget.attr('src')).load(function(){
    $targetWidth = this.width;
    $targetHeight = this.height;
  });
  
  function showPreview(coords) {
    if (parseInt(coords.w) > 0) {
      var rx = 160 / coords.w;
      var ry = 160 / coords.h;
      
      $jcropPreview.css({
        width: Math.round(rx * $targetWidth) + 'px',
        height: Math.round(ry * $targetHeight) + 'px',
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