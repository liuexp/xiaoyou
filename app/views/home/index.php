<?php
$title = '首页';
$no_sidebar = true;
$stylesheets = array('home');
include(__DIR__ . '/../layout/header.php');
?>
<section class="slogan">
  <img class="special-logo" src="<?php echo SITE_BASE; ?>/images/acm-special-logo.png"/>
  <img class="chinese" src="<?php echo SITE_BASE; ?>/images/chinese.png"/>
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
            <?php echo $article->getTitle(); ?>
            <!-- use dotdotdot to show abstract of each article -->
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
    <section>
      <h2>征文</h2>
      <ul>
        <li>
        </li>
      </ul>
    </section>
    <section>
      <h2>最新动态</h2>
      <ul>
        <li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
        <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
        <li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
        <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
      </ul>
    </section>
  </div>
</section>
<?php
include(__DIR__ . '/../layout/footer.php');
