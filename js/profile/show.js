$(function(){
  $('.add').fancybox({'hideOnOverlayClick': false});
  $('.edit').fancybox({'hideOnOverlayClick': false});
  
  if (window.uploadAvatar.result === 'failure') {
    $('#edit-avatar-form .failure').html(window.uploadAvatar.message).show();
    $('#edit-avatar-link').click();
  }
  
  $('.tweet').bind('closed', function(){
    alert('hi');
  });
  
  $('#edit-info-form').submit(function(){
    $('#edit-info-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/profile/' + window.profileId,
      data: $('#edit-info-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location.reload();
        } else if (data.message) {
          $('#edit-info-form .failure').html(data.message).show();
        } else {
          $('#edit-info-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#edit-info-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
  $('#add-experience-form').submit(function(){
    $('#add-experience-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/experiences',
      data: $('#add-experience-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location.reload();
        } else if (data.message) {
          $('#add-experience-form .failure').html(data.message).show();
        } else {
          $('#add-experience-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#add-experience-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
  $('#add-paper-form').submit(function(){
    $('#add-paper-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/papers',
      data: $('#add-paper-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location.reload();
        } else if (data.message) {
          $('#add-paper-form .failure').html(data.message).show();
        } else {
          $('#add-paper-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#add-paper-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
  $('#add-honor-form').submit(function(){
    $('#add-honor-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/honors',
      data: $('#add-honor-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
          window.location.reload();
        } else if (data.message) {
          $('#add-honor-form .failure').html(data.message).show();
        } else {
          $('#add-honor-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#add-honor-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });
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