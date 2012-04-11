<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="refresh" content="<?php echo $this->pollInterval; ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/chat.css"/>
</head>
<body onload="window.location='#bottom'">
<div class="container">
  <div class="messages message-list">
  <?php foreach ($this->messages as $message): ?>
    <article class="a-feed">
      <aside>
        <figure>
          <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $message->profileId; ?>">
            <?php if (file_exists(AVATAR_DIR . $message->loginName . '-mini.jpg')): ?>
              <img src="<?php echo AVATAR_BASE; ?>/<?php echo $message->loginName; ?>-mini.jpg" width="40px" height="40px"/>
            <?php else: ?>
              <img src="<?php echo SITE_BASE; ?>/images/avatar-40.jpg" width="40px" height="40px"/>
            <?php endif; ?>
          </a>
        </figure>
      </aside>
      <h3>
        <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $message->profileId; ?>"><?php echo $message->displayName; ?></a>
        <span>:</span>
        <span><?php echo TweetHelper::replaceEmotion(htmlspecialchars($message->content)); ?></span>
      </h3>
      <div class="details">
        <div class="legend">
          <span class="duration">
            <?php if (isset($message->timestamp)) echo $message->timestamp->getFuzzyDifference(); ?>
          </span>
        </div>
      </div>
    </article>
  <?php endforeach; ?>
  </div>
  <form class="form-horizontal" action="<?php echo SITE_BASE; ?>/chat" method="post">
    <fieldset>
      <div class="control-group">
        <label class="control-label" for="message"></label>
        <div class="controls">
          <div class="input-append">
            <input class="span4" id="message" type="text" name="message" size="140" maxlength="140"/>
            <button type="submit" class="btn">发送</button>
          </div>
        </div>
      </div>
    </fieldset>
  </form>
  <a id="bottom" name="bottom">&nbsp;</a>
</div><!-- /.container -->
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/hide-broken-images.js"></script>
</body>
</html>