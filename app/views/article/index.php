<?php
$title = '新闻';
$no_sidebar = true;
$stylesheets = array('jquery.fancybox-1.3.4', 'articles');
include(__DIR__ . '/../layout/header.php');
?>
<div style="clear:both;"><h1>
  <?php echo $title; ?>
  <?php if ($this->editable): ?>
    <a class="fancy-link" href="#new-article">
      <img src="<?php echo SITE_BASE; ?>/images/icons/page_add.png"/>
    </a>
  <?php endif; ?>
</h1>
</div>
<ul class="articles">
  <?php $need_intro = false; ?>
  <?php foreach ($this->articles as $article): ?>
    <?php if ($article->getPriority() < 100 && $need_intro): ?>
      <?php $need_intro = false; ?>
    <?php endif; ?>
    <li data-article-id="<?php echo $article->getId(); ?>">
      <a class="article-link" href="<?php echo SITE_BASE; ?>/article/<?php echo $article->getId(); ?>">
        <?php echo $article->getTitle(); ?>
      </a>
      <?php if ($this->editable): ?>
        <div class="tools">
          <a class="edit edit-article" href="<?php echo SITE_BASE; ?>/article/<?php echo $article->getId(); ?>/edit">
            <img src="<?php echo SITE_BASE; ?>/images/icons/page_edit.png"/>
          </a>
          <a class="delete delete-article" href="#"><img src="<?php echo SITE_BASE; ?>/images/icons/page_delete.png"/></a>
        </div>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
</ul>  
<?php if ($this->editable): ?>
<div style="display:none">
  <div id="new-article">
    <h1>添加新闻</h1>
    <form id="new-article-form" method="POST">
      <input type="hidden" name="type" value="news"/>
      <div class="field">
        <label for="title">标题：</label>
        <input class="textfield monofont" type="text" id="title" name="title" maxlength="200"/>
      </div>
      <div class="field">
        <textarea class="monofont" name="content" rows="10" cols="80"></textarea>
      </div>
      <div class="field">
        <label for="priority">优先级：</label>
        <input class="monofont" type="number" id="priority" name="priority" maxlength="10"/>
        <span class="hint">（优先级越高，显示的位置越靠前）</span>
      </div>
      <div class="field">
        <label class="long" for="visible">是否显示在新闻列表中：</label>
        <input type="checkbox" id="visible" name="visible" checked/>
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
</div>
<?php endif; ?>
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.fancybox-1.3.4.pack', 'jquery.easing-1.3.pack', 'jquery.mousewheel-3.0.4.pack', 'article/index.min');
include(__DIR__ . '/../layout/footer.php');
