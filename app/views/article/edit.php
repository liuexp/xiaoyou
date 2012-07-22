<script type="text/javascript">
<!--

$(document).ready(function()	{
$('#markdown2').markItUp(myMarkdownSettings).css('height', function() {
  /* Since line-height is set in the markItUp-css, fetch that value and
  split it into value and unit.  */
  var h = jQuery(this).css('line-height').match(/(\d+)(.*)/)
  /* Multiply line-height-value with nr-of-rows and add the unit.  */
  return (h[1]*jQuery(this).attr('rows'))+h[2]
});
});
-->
</script>


<div id="edit-article">
  <h1>编辑文章</h1>
  <form id="edit-article-form" method="POST" action="<?php echo SITE_BASE; ?>/article/<?php echo $this->article->getId(); ?>">
    <div class="field">
      <label for="type">类型：</label>
      <select id="type" name="type">
        <option value="news"<?php if ($this->article->getType() == 'news') echo ' selected'; ?>>新闻</option>
        <option value="post"<?php if ($this->article->getType() == 'post') echo ' selected'; ?>>讲座信息</option>
	<option value="culture"<?php if ($this->article->getType() == 'culture') echo ' selected'; ?>>人才培养</option>
        <option value="infrastructure"<?php if ($this->article->getType() == 'infrastructure') echo ' selected'; ?>>法学院建设</option>
        <option value="halloffame"<?php if ($this->article->getType() == 'halloffame') echo ' selected'; ?>>校友风采</option>
      </select>
    </div>
    <div class="field">
      <label for="edit-title">标题：</label>
      <input class="textfield monofont" type="text" id="edit-title" name="title" maxlength="200" value="<?php echo $this->article->getTitle(); ?>"/>
    </div>
    <div class="field">
      <textarea id="markdown2" class="monofont" name="content" rows="9" cols="63"><?php echo $this->article->getContent(); ?></textarea>
    </div>  
    <div class="field">
      <label for="priority">优先级：</label>
      <input class="monofont" type="number" id="priority" name="priority" maxlength="10" value="<?php echo $this->article->getPriority(); ?>"/>
      <span class="hint">（优先级越高，显示的位置越靠前）</span>
    </div>
    <div class="field">
      <label class="long" for="visible">是否显示在列表中：</label>
      <input type="checkbox" id="visible" name="visible"<?php if ($this->article->getVisible()) echo ' checked'; ?>/>
      <span class="hint">（设为不显示只对普通用户有效，网站编辑仍旧可以访问）</span>
    </div>
    <div class="failure" style="display:none"></div>
    <div class="action">
      <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
        <span>提交</span>
      </button>
    </div>
    <p class="clear"></p>
  </form>
</div>
<script type="text/javascript">window.articleId = '<?php echo $this->article->getId(); ?>';</script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/article/edit.min.js"></script>
