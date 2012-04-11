<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="refresh" content="<?php echo 4 * $this->pollInterval; ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/redis.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/chat.css"/>
</head>
<body>
<div class="container">
  <div class="users user-list">
  <?php foreach ($this->users as $username): ?>
    <?php if (!UserHelper::hasProfile($username)) continue; ?>
    <?php $profile = new Profile(UserHelper::getProfileId($username)); ?>
    <article class="a-feed">
      <aside>
        <figure>
          <a target="_blank" href="<?php echo SITE_BASE; ?>/profile/<?php echo $profile->getId(); ?>">
            <?php if (file_exists(AVATAR_DIR . $username . '-mini.jpg')): ?>
              <img src="<?php echo AVATAR_BASE; ?>/<?php echo $username; ?>-mini.jpg" width="40px" height="40px"/>
            <?php else: ?>
              <img src="<?php echo SITE_BASE; ?>/images/avatar-40.jpg" width="40px" height="40px"/>
            <?php endif; ?>
          </a>
        </figure>
      </aside>
      <h3>
        <a target="_blank" href="<?php echo SITE_BASE; ?>/profile/<?php echo $profile->getId(); ?>"><?php echo $profile->getDisplayName(); ?></a>
      </h3>
      <div class="details">
        <div class="legend">
          <span class="duration"><?php echo $profile->getStartYear(); ?>级</span>
        </div>
      </div>
    </article>
  <?php endforeach; ?>
  </div>
</div><!-- /.container -->
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/hide-broken-images.js"></script>
</body>
</html>