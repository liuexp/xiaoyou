<?php
$title = '编辑头像';
$no_sidebar = true;
$stylesheets = array('jquery.Jcrop', 'avatar');
include(__DIR__ . '/../layout/header.php');
?>
<h1><?php echo $title; ?></h1>
<div class="hint success">请用鼠标在左侧大图选取要作为头像的部分</div>
<div class="failure" style="display:none"></div>
<form id="edit-avatar-form" method="POST" action="<?php echo SITE_BASE; ?>/avatar/update">
  <input type="hidden" id="x" name="x" value="0"/>
  <input type="hidden" id="y" name="y" value="0"/>
  <input type="hidden" id="w" name="w" value="160"/>
  <input type="hidden" id="h" name="h" value="160"/>
  <input type="hidden" id="img_w" name="img_w"/>
  <input type="hidden" id="img_h" name="img_h"/>
  <div>
    <img src="<?php echo AVATAR_BASE; ?>/<?php echo $this->username; ?>.jpg" id="jcrop_target"/>
  </div>
  <div style="width:160px;height:160px;overflow:hidden;margin-left:5px;">
    <img src="<?php echo AVATAR_BASE; ?>/<?php echo $this->username; ?>.jpg" id="jcrop_preview"/>
  </div>
  <div class="action">
    <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
      <span>保存选取的位置</span>
    </button>
  </div>
  <p class="clear"></p>
</form>
<script type="text/javascript">window.profileId = '<?php echo UserHelper::getProfileId(); ?>';</script>
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.Jcrop.min', 'avatar/edit.min');
include(__DIR__ . '/../layout/footer.php');
