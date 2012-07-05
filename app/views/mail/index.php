<?php
$title = '短信息';
$no_sidebar = true;
$stylesheets = array('bootstrap.min', 'tweets');
include(__DIR__ . '/../layout/header.php');
?>
<div class="timeline feed-list">
  <h1>
短信息 </h1> 

  <?php if (fAuthorization::checkLoggedIn()): ?>
    <form class="well form-search w500" action="<?php echo SITE_BASE; ?>/inbox" method="post" onsubmit="$.blockUI();">
      <input type="hidden" name="quick" value="true"/>
      <?php if ($tweet_success = fMessaging::retrieve('success', 'create mail')): ?>
        <div class="alert alert-success fade in">
          <a class="close" data-dismiss="alert">&times;</a>
          <?php echo $tweet_success; ?>
        </div>
      <?php endif; ?>
      <?php if ($tweet_failure = fMessaging::retrieve('failure', 'create mail')): ?>
        <div class="alert alert-error fade in">
          <a class="close" data-dismiss="alert">&times;</a>
          <?php echo $tweet_failure; ?>
        </div>
      <?php endif; ?>
      <div class="controls">
        <input name="dest" type="text" class="input-xlarge" maxlength="140" placeholder="收件人用户名"/>
        <input name="mail-content" type="text" class="span6 input-xlarge" maxlength="140" placeholder="说点什么吧⋯⋯"/>
<br/>
        <button type="submit" class="btn btn-danger btn-large">发送</button>
      </div>
    </form>
  <?php endif; ?>
<?php foreach ($this->mail as $mail): ?>
  <?php
    $profile = $mail->getSendProfile();
    $profile2 = $mail->getRecvProfile();
    $username1 = $profile->getLoginName();
    $avatarfile = AVATAR_DIR . $username1 . '-mini.jpg';
  ?>

              <blockquote class="tweet fade in well w500" data-mail-id="<?php echo $mail->getId(); ?>">
                  <a class="close" data-dismiss="alert">&times;</a>
  <article class="a-feed" id="mail-<?php echo $mail->getId(); ?>">
    <aside>
      <figure>
        <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $profile->getId(); ?>">
          <?php if (file_exists($avatarfile)): ?>
            <img src="<?php echo AVATAR_BASE; ?>/<?php echo $username1; ?>-mini.jpg" width="40px" height="40px"/>
          <?php else: ?>
            <img src="<?php echo SITE_BASE; ?>/images/avatar-40.jpg" width="40px" height="40px"/>
          <?php endif; ?>
        </a>
      </figure>
    </aside>
    <h3>
      <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $profile->getId(); ?>"><?php echo $profile->getDisplayName(); ?></a>
      <span>对 <?php echo $profile2->getDisplayName();?> 说 </span>
      <span>:</span>
      <span><?php echo TweetHelper::replaceEmotion(htmlspecialchars($mail->getContent())); ?></span>
<br/>
  <small class="pull-right">发送于<?php echo $mail->getTimestamp()->getFuzzyDifference(); ?>（<?php echo $mail->getTimestamp(); ?>）</small>
                <p class="clear"></p>

    </h3>
    <div class="details">
      <div class="legend">
        <a class="reply" href="javascript:void(0)">
          回复<?php if ($cc = $mail->getReplies()->count()): ?>(<?php echo $cc; ?>)<?php endif; ?>
        </a>
      </div>
    </div>

    <div class="comments" >
<?php foreach ($mail->getReplies() as $comment): ?>
  <?php $replier = $comment->getSendProfile(); ?>
  <blockquote data-tweet-comment-id="<?php echo $comment->getId(); ?>">
    <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $replier->getId(); ?>"><?php echo $replier->getDisplayName(); ?></a>
    <span>:</span>
    <span><?php echo TweetHelper::replaceEmotion(htmlspecialchars($comment->getContent())); ?></span>
    <small><?php echo $comment->getTimestamp()->getFuzzyDifference(); ?></small>
  </blockquote>
<?php endforeach; ?>

<form class="form-search" action="<?php echo SITE_BASE; ?>/inbox" method="post" onsubmit="$.blockUI();">
  <div class="controls">
    <div class="input-append">
    <input name="destre" type="hidden" value="<?php echo $mail->getSender(); ?>" />
    <input name="parent" type="hidden" value="<?php echo $mail->getId(); ?>" />
      <input name="mail-content" type="text" class="input-xlarge" maxlength="140" placeholder="这里输入回复内容"/>
      <button type="submit" class="btn btn-success btn-small">添加回复</button>
    </div>
  </div>

</form>

    </div>
  </article>

              </blockquote>
<?php endforeach; ?>
</div>
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.blockui.min', 'bootstrap.min', 'hide-broken-images','mail/inbox','jquery.fancybox-1.3.4.pack', 'jquery.easing-1.3.pack', 'jquery.mousewheel-3.0.4.pack','toggle-comments');
    
include(__DIR__ . '/../layout/footer.php');
