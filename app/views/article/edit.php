<div id="edit-article">
  <h1>编辑文章</h1>
  <form id="edit-article-form" method="POST" action="<?php echo SITE_BASE; ?>/article/<?php echo $this->article->getId(); ?>">
    <div class="field">
      <label for="type">类型：</label>
      <select id="type" name="type">
        <option value="news"<?php if ($this->article->getType() == 'news') echo ' selected'; ?>>新闻</option>
        <option value="post"<?php if ($this->article->getType() == 'post') echo ' selected'; ?>>征文</option>
      </select>
    </div>
    <div class="field">
      <label for="edit-title">标题：</label>
      <input class="textfield monofont" type="text" id="edit-title" name="title" maxlength="200" value="<?php echo $this->article->getTitle(); ?>"/>
    </div>
    <div class="field">
      <textarea class="monofont" name="content" rows="9" cols="80"><?php echo $this->article->getContent(); ?></textarea>
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