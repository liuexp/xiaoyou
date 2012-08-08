<?php
$title = '已知校友管理';
$no_sidebar = true;
$stylesheets = array('jquery.fancybox-1.3.4', 'articles');
include(__DIR__ . '/../layout/header.php');
$this->editable=true;
?>
<div style="clear:both">
<h1>
  <?php echo $title; ?>
  <?php if ($this->editable): ?>
    <a class="fancy-link" href="#new-users">
      <img src="<?php echo SITE_BASE; ?>/images/icons/page_add.png"/>
    </a>
  <?php endif; ?>
</h1>
</div>
<ul class="articles">
  <?php foreach ($this->users as $user): ?>
    <li data-article-id="<?php echo $user->getId(); ?>">
        <?php echo $user->getRealname(); ?>
      <?php if ($this->editable): ?>
        <div class="tools">
          <a class="edit edit-users" href="<?php echo SITE_BASE; ?>/manage_users/<?php echo $user->getId(); ?>/edit">
            <img src="<?php echo SITE_BASE; ?>/images/icons/page_edit.png"/>
          </a>
          <a class="delete delete-users" href="#"><img src="<?php echo SITE_BASE; ?>/images/icons/page_delete.png"/></a>
        </div>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
</ul>
<?php if ($this->editable): ?>
<div style="display:none">
  <div id="new-users">
    <h1>添加校友</h1>
    <form id="new-users-form" method="POST">
      <input type="hidden" name="type" value="post"/>
      <div class="field">
        <label for="realname">真实姓名</label>
        <input class="monofont" type="text" id="realname" name="realname" maxlength="200"/>
      </div>
      <div class="field">
        <label for="stuid">学号</label>
        <input class="monofont" type="text" id="stuid" name="stuid" maxlength="200"/>
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
$javascripts = array('jquery-1.7.1.min', 'jquery.fancybox-1.3.4.pack', 'jquery.easing-1.3.pack', 'jquery.mousewheel-3.0.4.pack', 'users/index.min');
include(__DIR__ . '/../layout/footer.php');
