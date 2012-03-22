<?php
$title = '编辑头像';
$no_sidebar = true;
$stylesheets = array('jquery.Jcrop', 'avatar');
include(__DIR__ . '/../layout/header.php');
?>
<h1><?php echo $title; ?></h1>
<span class="hint">请用鼠标在左侧大图选取要作为头像的部分</span>
<form id="edit-avatar">
  <img src="<?php echo AVATAR_BASE; ?>/<?php echo $this->username; ?>.jpg" id="jcrop_target"/>
  <div style="width:160px;height:160px;overflow:hidden;margin-left:5px;">
    <img src="<?php echo AVATAR_BASE; ?>/<?php echo $this->username; ?>.jpg" id="jcrop_preview"/>
  </div>
  <div class="failure" style="display:none"></div>
  <div class="action">
    <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
      <span>保存选取的位置</span>
    </button>
  </div>
  <p class="clear"></p>
</form>
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.Jcrop.min', 'avatar/edit');
include(__DIR__ . '/../layout/footer.php');
