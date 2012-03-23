$(function(){
  $('#counter').countdown({
    image: window.siteBase + '/images/digits.png',
    startTime: '01:12:12:00',
    timerEnd: function(){
      window.location.reload();
    }
  });
});