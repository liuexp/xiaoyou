$(function(){
  // $('.article-link').fancybox({'centerOnScroll': true});
  $('.fancy-link').fancybox({'hideOnOverlayClick': false});
  $('.edit').fancybox({'hideOnOverlayClick': false});
  $('#new-article-form').submit(function(){
    $('#new-article-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/articles',
      data: $('#new-article-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location.reload();
        } else if (data.message) {
          $('#new-article-form .failure').html(data.message).show();
        } else {
          $('#new-article-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#new-article-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
  $('.delete-article').click(function(){
    if (confirm('确定要删除这篇文章吗？')) {
      // TODO lock screen
      $.ajax({
        type: 'DELETE',
        url: window.siteBase + '/article/' + $(this).parent().parent().attr('data-article-id'),
        dataType: 'json',
        el: $(this),
        success: function(data, textStatus, jqXHR){
          if (data.result === 'success') {
            this.el.parent().parent().remove();
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