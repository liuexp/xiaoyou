function close() {
  var a = document.getElementById('pop_back');
  a.style.display = 'none';
}
window.onscroll = function() {
  var a = document.getElementById('pop_back');
  a.style.top = document.body.scrollTop + document.body.clientHeight - 268;
}
