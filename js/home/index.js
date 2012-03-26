$(function(){
  $('#counter').countdown({
    image: window.siteBase + '/images/digits' + window.digitsSuffix,
    startTime: $('#counter').attr('data-start-time'),
    format: "dd天hh:mm:ss",
    timerEnd: function(){
      window.location.reload();
    }
  });
  $('.cntSeparator').first().addClass('cntSeparatorFirst');
});