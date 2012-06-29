<?php
$title = '首页';
$no_sidebar = true;
$stylesheets = array('home');
include(__DIR__ . '/../layout/header.php');
?>
<section class="main">
  <p class="firstpara">　　
上海交通大学的法学教育可以上溯到20世纪之初南洋公学时期的政治特班。
南洋公学于1901年举办政治特班，由蔡元培先生主持，在当时，科举制度还没有废除，为了给处于大变革时代的中国社会培养具有现代学识的治国人才，特班“专教中西政治、文学、法律、道德诸学”，开设了宪法、国际公法、行政纲要等课程，从而使南洋公学成为首批开展近现代法学教育的中国高等学府之一。 
</p>
  <div class="columns">
    <section>
      <h2 class="big">新闻</h2>
      <ul class="itemize">
        <?php $need_intro = false; ?>
        <?php foreach ($this->articles as $article): ?>
          <?php if ($article->getPriority() < 100 && $need_intro): ?>
            <?php $need_intro = false; ?>
          <?php endif; ?>
          <li data-article-id="<?php echo $article->getId(); ?>">
            <a href="<?php echo SITE_BASE; ?>/article/<?php echo $article->getId(); ?>"><?php echo $article->getShortTitle(); ?></a>
            <?php if ($article->isRecent()): ?><img src="<?php echo SITE_BASE; ?>/images/new.gif"/><?php endif; ?>
          </li>
        <?php endforeach; ?>
        <li class="more"><a href="<?php echo SITE_BASE; ?>/articles">更多⋯⋯</a></li>
      </ul>
    </section>
    <section>
      <h2 class="big">讲座信息</h2>
      <ul class="itemize">
        <?php $first_post = true; ?>
        <?php foreach ($this->posts as $article): ?>
          <li data-article-id="<?php echo $article->getId(); ?>">
            <a href="<?php echo SITE_BASE; ?>/article/<?php echo $article->getId(); ?>"><?php echo $article->getShortTitle(); ?></a>
            <?php if ($first_post): ?>
              <!-- <img src="<?php echo SITE_BASE; ?>/images/new.gif"/> -->
              <?php $first_post = false; ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
        <li class="more"><a href="<?php echo SITE_BASE; ?>/posts">更多⋯⋯</a></li>
      </ul>
    </section>
    <section>
      <h2 class="big">最新动态</h2>
      <ul class="itemize">
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
$javascripts = array('jquery-1.4.2.min', 'jquery.countdown', 'home/index');
include(__DIR__ . '/../layout/footer.php');
