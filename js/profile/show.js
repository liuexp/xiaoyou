$(function(){
  $('.add').fancybox({'hideOnOverlayClick': false});
  // TODO edit experience
  // TODO edit paper
  // TODO edit honor
  $('.delete-experience').click(function(){
    if (confirm('确定要删除这条经历吗？')) {
      // TODO lock screen
      $.ajax({
        type: 'DELETE',
        url: window.siteBase + '/experience/' + $(this).parent().parent().attr('data-experience-id'),
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
  $('.delete-paper').click(function(){
    if (confirm('确定要删除这篇论文吗？')) {
      // TODO lock screen
      $.ajax({
        type: 'DELETE',
        url: window.siteBase + '/paper/' + $(this).parent().parent().attr('data-paper-id'),
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
  $('.delete-honor').click(function(){
    if (confirm('确定要删除这项荣誉吗？')) {
      // TODO lock screen
      $.ajax({
        type: 'DELETE',
        url: window.siteBase + '/honor/' + $(this).parent().parent().attr('data-honor-id'),
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