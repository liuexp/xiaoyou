<?php
$title = '编辑头像';
$no_sidebar = true;
$stylesheets = array('jquery.Jcrop');
include(__DIR__ . '/../layout/header.php');
?>
<h1><?php echo $title; ?></h1>
<p class="clear"></p>
<img src="<?php echo AVATAR_BASE; ?>/<?php echo $this->username; ?>.jpg" id="jcrop_target"/>
<div style="width:160px;height:160px;overflow:hidden;margin-left:5px;">
  <img src="<?php echo AVATAR_BASE; ?>/<?php echo $this->username; ?>.jpg" id="jcrop_preview"/>
</div>
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.Jcrop.min', 'avatar/edit');
include(__DIR__ . '/../layout/footer.php');
