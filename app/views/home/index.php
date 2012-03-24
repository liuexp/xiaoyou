<?php
$title = '首页';
$no_sidebar = true;
$stylesheets = array('home');
include(__DIR__ . '/../layout/header.php');
?>
<?php if ($this->reach_countdown): ?>
  <section class="slogan">
    <img class="special-logo" src="<?php echo SITE_BASE; ?>/images/acm-special-logo.png"/>
    <img class="chinese" src="<?php echo SITE_BASE; ?>/images/chinese.png"/>
  </section>
<?php else: ?>
  <section class="cdown">
    <img class="special-logo" src="<?php echo SITE_BASE; ?>/images/acm-special-logo.png"/>
    <div class="message">距离十周年庆典还有</div>
    <div class="countdown">
      <div id="counter" data-start-time="<?php echo sprintf("%02d天%02d:%02d:%02d", $this->days, $this->hours, $this->minutes, $this->seconds); ?>"></div>
      <!--<div class="desc">
        <div>天</div>
        <div>小时</div>
        <div>分钟</div>
        <div>秒</div>
      </div>-->
    </div>
  </section>
<?php endif; ?>
<section class="main">
  <p class="firstpara">　　十年前的3月，上海交通大学夺得ACM国际大学生程序设计竞赛世界冠军，这是亚洲有史以来该赛事的第一个世界冠军，也是交大计算机专业的本科生有史以来第一次站在世界舞台的最高点。</p>
  <p class="secondpara">　　这一成绩给予了我们极大地鼓舞，同时我们思考：如果我们的学生能够站在世界科学舞台的最高点，那将更加彰显中国实力。由此揭开了上海交通大学计算机科学与技术高瑞人才培养的序幕⋯⋯<span style="font-style:italic">（<a href="<?php echo SITE_BASE; ?>/intro">继续阅读ACM班简介</a>）</span></p>
  <div class="columns">
    <section>
      <h2 class="big">新闻</h2>
      <ul>
        <?php foreach ($this->articles as $article): ?>
          <li data-article-id="<?php echo $article->getId(); ?>">
            <a href="<?php echo SITE_BASE; ?>/article/<?php echo $article->getId(); ?>"><?php echo $article->getShortTitle(); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
    <section>
      <h2 class="big">征文</h2>
      <ul>
        <?php foreach ($this->posts as $article): ?>
          <li data-article-id="<?php echo $article->getId(); ?>">
            <a href="<?php echo SITE_BASE; ?>/article/<?php echo $article->getId(); ?>"><?php echo $article->getShortTitle(); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
    <section>
      <h2 class="big">最新动态</h2>
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
$javascripts = array('jquery-1.7.1.min', 'jquery.countdown.min', 'jquery.dotdotdot-1.4.0-packed', 'home/index');
include(__DIR__ . '/../layout/footer.php');
