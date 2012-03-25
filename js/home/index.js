$(function(){
  $('#counter').countdown({
    image: window.siteBase + '/images/digits' + window.digitsSuffix,
    startTime: $('#counter').attr('data-start-time'),
    timerEnd: function(){
      window.location.reload();
    }
  });
  $('.cntSeparator').first().addClass('cntSeparatorFirst');
});