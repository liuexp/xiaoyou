<?php
$title = $this->article->getTitle();
$no_sidebar = true;
$stylesheets = array('bootstrap.min', 'article');
include(__DIR__ . '/../layout/header.php');
?>
<article><?php echo Markdown($this->article->getContent()); ?></article>
<div class="comments comment-list">
  <h2>评论</h2>
<?php foreach ($this->article->getComments() as $comment): ?>
  <?php
    $profile = $comment->getProfile();
    $username = $profile->getLoginName();
    $avatarfile = AVATAR_DIR . $username . '-mini.jpg';
  ?>
  <article class="a-feed" id="comment-<?php echo $comment->getId(); ?>">
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
      <span><?php echo htmlspecialchars($comment->getContent()); ?></span>
    </h3>
    <div class="details">
      <div class="legend">
        <span class="duration"><?php echo $comment->getTimestamp()->getFuzzyDifference(); ?></span>
      </div>
    </div>
  </article>
<?php endforeach; ?>
<?php if (fAuthorization::checkLoggedIn()): ?>
  <form id="comment-form" class="pull-left" action="<?php echo SITE_BASE; ?>/article/<?php echo $this->article->getId(); ?>/reply" method="post">
    <?php if ($artcom_success = fMessaging::retrieve('success', 'create article comment')): ?>
      <div class="alert alert-success fade in">
        <a class="close" data-dismiss="alert">&times;</a>
        <?php echo $artcom_success; ?>
      </div>
    <?php endif; ?>
    <?php if ($artcom_failure = fMessaging::retrieve('failure', 'create article comment')): ?>
      <div class="alert alert-error fade in">
        <a class="close" data-dismiss="alert">&times;</a>
        <?php echo $artcom_failure; ?>
      </div>
    <?php endif; ?>
    <div class="controls">
      <button type="submit" class="btn btn-success btn-large pull-right">
        <i class="icon-comment icon-white"></i>
        发表评论
      </button>
      <textarea name="article-comment" type="text" class="input-xlarge pull-right" maxlength="240" placeholder="说点什么吧⋯⋯"></textarea>
      <p class="clear"></p>
    </div>
  </form>  
  <p class="clear"></p>
<?php endif; ?>
</div>
<?php
$javascripts = array('jquery-1.7.1.min', 'bootstrap.min');
include(__DIR__ . '/../layout/footer.php');
