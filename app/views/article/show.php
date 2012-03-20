<?php
$title = $this->article->getTitle();
$no_sidebar = true;
$stylesheets = array('article');
include(__DIR__ . '/../layout/header.php');
?>
<h1><?php echo $title; ?></h1>
<article><?php echo Markdown($this->article->getContent()); ?></article>
<?php
include(__DIR__ . '/../layout/footer.php');
