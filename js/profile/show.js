$(function(){
  $('.add').fancybox({'hideOnOverlayClick': false});
  $('.delete-experience').click(function(){
    if (confirm('确定要删除这条经历吗？')) {
      // TODO lock screen
      // TODO ajax deletion
      // TODO unlock screen
    }
  });
  $('.delete-paper').click(function(){
    if (confirm('确定要删除这篇论文吗？')) {
      // TODO lock screen
      // TODO ajax deletion
      // TODO unlock screen
    }
  });
  $('.delete-honor').click(function(){
    if (confirm('确定要删除这项荣誉吗？')) {
      // TODO lock screen
      // TODO ajax deletion
      // TODO unlock screen
    }
  });
});