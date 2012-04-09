<?php
$title = '微博';
$no_sidebar = true;
$stylesheets = array('bootstrap.min', 'tweets');
include(__DIR__ . '/../layout/header.php');
?>
<div class="timeline feed-list">
  <h1>最新微博</h1>
<?php foreach ($this->tweets as $tweet): ?>
  <?php
    $profile = $tweet->getProfile();
    $username = $profile->getLoginName();
    $avatarfile = AVATAR_DIR . $username . '-mini.jpg';
  ?>
  <article class="a-feed" id="tweet-<?php echo $tweet->getId(); ?>">
    <aside>
      <figure>
        <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $profile->getId(); ?>">
          <?php if (file_exists($avatarfile)): ?>
            <img src="<?php echo AVATAR_BASE; ?>/<?php echo $username; ?>-mini.jpg" width="40px" height="40px"/>
          <?php else: ?>
            <img src="<?php echo SITE_BASE; ?>/images/avatar-40.jpg" width="40px" height="40px"/>
          <?php endif; ?>
        </a>
      </figure>
    </aside>
    <h3>
      <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $profile->getId(); ?>"><?php echo $profile->getDisplayName(); ?></a>
      <span>:</span>
      <span><?php echo htmlspecialchars($tweet->getContent()); ?></span>
    </h3>
    <div class="details">
      <div class="legend">
        <span class="duration"><?php echo $tweet->getTimestamp()->getFuzzyDifference(); ?></span>
      </div>
    </div>
    <div class="comments">
      <?php include(__DIR__ . '/_comments.php'); ?>
    </div>
  </article>
<?php endforeach; ?>
</div>
<?php
$javascripts = array('jquery-1.7.1.min', 'bootstrap.min');
include(__DIR__ . '/../layout/footer.php');
