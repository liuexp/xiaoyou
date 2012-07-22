$(function(){
  $('.delete-tweet').click(function(){
    if (confirm('确定要删除这条微博吗？')) {
      // TODO lock screen
      $.ajax({
        type: 'DELETE',
        url: window.siteBase + '/tweet/' + $(this).attr('data-tweet-id'),
        dataType: 'json',
        el: $(this),
        success: function(data, textStatus, jqXHR){
          if (data.result === 'success') {
            this.el.parent().parent().parent().remove();
          } else if (data.message) {
            alert(data.message);
          } else {
            alert('Unknown: ' + textStatus);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert('Error: ' + textStatus);
        },
        complete: function(){
          // TODO unlock screen
        }
      });
    }
  });
});
