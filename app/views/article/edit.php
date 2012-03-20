<div id="edit-article">
  <h1>编辑新闻</h1>
  <form id="edit-article-form" method="POST" action="<?php echo SITE_BASE; ?>/article/<?php echo $this->article->getId(); ?>">
    <div class="field">
      <label for="edit-title">标题：</label>
      <input class="textfield monofont" type="text" id="edit-title" name="title" maxlength="200" value="<?php echo $this->article->getTitle(); ?>"/>
    </div>
    <div class="field">
      <textarea class="monofont" name="content" rows="10" cols="80"><?php echo $this->article->getContent(); ?></textarea>
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
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/article/edit.js"></script>