<?php
$title = '管理';
$no_sidebar = true;
$stylesheets = array('bootstrap.min','jquery.fancybox-1.3.4', 'articles');
include(__DIR__ . '/../layout/header.php');
?>
<div style="clear:both">
<h1>
已知校友管理
    <a class="fancy-link" href="#new-users" title="添加一个用户">
      <img src="<?php echo SITE_BASE; ?>/images/icons/page_add.png"/>
    </a>
    <a class="fancy-link" href="#import-users" title="批量添加用户">
      <img src="<?php echo SITE_BASE; ?>/images/icons/table_add.png"/>
    </a>

</h1>
</div>
<section>
<ul class="articles">
  <?php foreach ($this->users as $user): ?>
    <li data-article-id="<?php echo $user->getId(); ?>">
        <?php echo $user->getRealname(); ?>
        <div class="tools">
          <a class="edit edit-users" href="<?php echo SITE_BASE; ?>/manage_users/<?php echo $user->getId(); ?>/edit">
            <img src="<?php echo SITE_BASE; ?>/images/icons/page_edit.png"/>
          </a>
          <a class="delete delete-users" href="#"><img src="<?php echo SITE_BASE; ?>/images/icons/page_delete.png"/></a>
        </div>
    </li>
  <?php endforeach; ?>
</ul>


</section>
<h1>
群发邮件
</h1>
<section>
</section>

<h1>
批量导出
</h1>
<section>
<ul >
<a  class="btn btn-primary btn-large" href = "<?php echo SITE_BASE; ?>/export/csv"><font color="#FFF">批量导出为CSV</font></a>
</ul>
</section>
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
        <label for="stuid">本科学号</label>
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

<div style="display:none">
  <div id="import-users">
    <h1>批量添加校友</h1>
    <form id="import-users-form" method="POST">
      <input type="hidden" name="type" value="post"/>
      <div class="field">
        <label for="content">列表:</label>
(其中第一列为校友真实姓名，第二列为学号)
<p>
<textarea class="monofont" name="content" rows=10 cols=80>
</textarea>
</p>
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
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.fancybox-1.3.4.pack', 'jquery.easing-1.3.pack', 'jquery.mousewheel-3.0.4.pack', 'admin/index.min');
include(__DIR__ . '/../layout/footer.php');
