<?php
$title = '微博';
$no_sidebar = true;
$stylesheets = array('bootstrap.min', 'tweets');
include(__DIR__ . '/../layout/header.php');
?>
<div class="timeline feed-list">
  <h1>最新微博</h1>
  <?php if (fAuthorization::checkLoggedIn()): ?>
  <center>
    <form class="well form-search w500" action="<?php echo SITE_BASE; ?>/tweets" method="post" onsubmit="$.blockUI();">
      <input type="hidden" name="quick" value="true"/>
      <?php if ($tweet_success = fMessaging::retrieve('success', 'create tweet')): ?>
        <div class="alert alert-success fade in">
          <a class="close" data-dismiss="alert">&times;</a>
          <?php echo $tweet_success; ?>
        </div>
      <?php endif; ?>
      <?php if ($tweet_failure = fMessaging::retrieve('failure', 'create tweet')): ?>
        <div class="alert alert-error fade in">
          <a class="close" data-dismiss="alert">&times;</a>
          <?php echo $tweet_failure; ?>
        </div>
      <?php endif; ?>
      <div class="controls">
        <input name="tweet-content" type="text" class="input-xlarge input-btn-large" maxlength="140" placeholder="说点什么吧⋯⋯"/>
        <button type="submit" class="btn btn-danger btn-large btn-input-large">发表新微博</button>
      </div>
    </form>
  </center>
  <?php endif; ?>
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
      <span><?php echo TweetHelper::replaceEmotion(htmlspecialchars($tweet->getContent())); ?></span>
    </h3>
    <div class="details">
      <div class="legend">
        <span class="duration"><?php echo $tweet->getTimestamp()->getFuzzyDifference(); ?></span>
        <a class="reply" href="javascript:void(0)">
          回复<?php if ($cc = $tweet->getComments()->count()): ?>(<?php echo $cc; ?>)<?php endif; ?>
        </a>
      </div>
    </div>
    <div class="comments">
      <?php include(__DIR__ . '/_comments.php'); ?>
    </div>
  </article>
<?php endforeach; ?>
</div>
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.blockui.min', 'bootstrap.min', 'hide-broken-images', 'toggle-comments');
include(__DIR__ . '/../layout/footer.php');
