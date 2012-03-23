<?php
$title = 'ACM班宣传片';
$no_sidebar = true;
$stylesheets = array('article');
include(__DIR__ . '/../layout/header.php');
?>
<h1><?php echo $title; ?></h1>
<article>
  <a href="<?php echo ACM_CLASS_FLV; ?>" style="display:block;width:480px;height:360px;" id="player"></a>
</article>
<?php
$javascripts = array('jquery-1.7.1.min', 'flowplayer-3.2.8.min', 'video/show');
include(__DIR__ . '/../layout/footer.php');
