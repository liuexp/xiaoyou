<?php
$title = $this->article->getTitle();
$no_sidebar = true;
$stylesheets = array('article');
include(__DIR__ . '/../layout/header.php');
?>
<div style="clear:both">
<h1 class="title"><?php echo $title; ?></h1>
</div>
<article><?php echo Markdown($this->article->getContent()); ?></article>
<?php
include(__DIR__ . '/../layout/footer.php');
