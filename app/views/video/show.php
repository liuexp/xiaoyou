<?php
$title = 'ACM班简介';
$no_sidebar = true;
$stylesheets = array('article');
include(__DIR__ . '/../layout/header.php');
?>
<h1>构筑计算机人才“金字塔”，打造计算机教育“中华牌”</h1>
<article>
  <section>
    <p class="clear"/>
    <?php echo Markdown(file_get_contents(__DIR__ . '/../../../doc/acm-intro.markdown')); ?>
  </section>
  <section>
    <center>
      <a href="<?php echo ACM_CLASS_FLV; ?>" style="display:block;width:480px;height:360px;" id="player"></a>
    </center>
  </section>
</article>
<?php
$javascripts = array('jquery-1.7.1.min', 'flowplayer-3.2.8.min', 'video/show');
include(__DIR__ . '/../layout/footer.php');
