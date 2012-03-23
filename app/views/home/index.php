<?php
$title = '首页';
$no_sidebar = true;
$stylesheets = array('home');
include(__DIR__ . '/../layout/header.php');
?>
<section class="slogan">
<!--
  <img class="special-logo" src="<?php echo SITE_BASE; ?>/images/acm-special-logo.png"/>
  <img class="chinese" src="<?php echo SITE_BASE; ?>/images/chinese.png"/>
-->
  <div class="countdown">
    <div id="counter"></div>
    <div class="desc">
      <div>天</div>
      <div>小时</div>
      <div>分钟</div>
      <div>秒</div>
    </div>
  </div>
</section>
<section class="main">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  <div class="columns">
    <section>
      <h2>新闻</h2>
      <ul>
        <?php foreach ($this->articles as $article): ?>
          <li data-article-id="<?php echo $article->getId(); ?>">
            <a href="<?php echo SITE_BASE; ?>/article/<?php echo $article->getId(); ?>"><?php echo $article->getTitle(); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
    <section>
      <h2>征文</h2>
      <ul>
        <?php foreach ($this->posts as $article): ?>
          <li data-article-id="<?php echo $article->getId(); ?>">
            <a href="<?php echo SITE_BASE; ?>/article/<?php echo $article->getId(); ?>"><?php echo $article->getTitle(); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
    <section>
      <h2>最新动态</h2>
      <ul>
        <?php foreach ($this->activities as $activity): ?>
          <li>
            <?php include(__DIR__ . '/_activity.php'); ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
  </div>
</section>
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.countdown', 'home/index');
include(__DIR__ . '/../layout/footer.php');
