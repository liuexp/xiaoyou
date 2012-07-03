<?php
$title = '帮助';
$no_sidebar = true;
$stylesheets = array('article');
include(__DIR__ . '/../layout/header.php');
?>
<h1 style="float:none;text-align:center">帮助文档</h1>
<article>
  <section>
    <p class="clear"/>
    <?php echo Markdown(file_get_contents(__DIR__ . '/../../../doc/help.markdown')); ?>
  </section>
</article>
<?php
$javascripts = array('jquery-1.7.1.min', 'flowplayer-3.2.8.min', 'video/show');
include(__DIR__ . '/../layout/footer.php');
