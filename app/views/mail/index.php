<?php
$title = '短信息';
$no_sidebar = true;
$stylesheets = array('bootstrap.min', 'tweets');
include(__DIR__ . '/../layout/header.php');
?>
<div class="timeline feed-list">
  <h1>
<?php if ($this->isInbox): ?>
收件箱 </h1> <h3>>>> <a href="<?php echo SITE_BASE; ?>/outbox">发件箱</a></h3>
<?php else: ?>
发件箱 </h1> <h3>>>> <a href="<?php echo SITE_BASE; ?>/inbox">收件箱</a> </h3>
<?php endif; ?>

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
    $profile = $this->isInbox?$mail->getSendProfile():$mail->getRecvProfile();
    $username = $profile->getLoginName();
    $avatarfile = AVATAR_DIR . $username . '-mini.jpg';
  ?>

              <blockquote class="tweet fade in well w500" data-mail-id="<?php echo $mail->getId(); ?>">
                  <a class="close" data-dismiss="alert">&times;</a>
  <article class="a-feed" id="mail-<?php echo $mail->getId(); ?>">
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
      <span><?php echo TweetHelper::replaceEmotion(htmlspecialchars($mail->getContent())); ?></span>
    </h3>

    <div class="comments" >
<form class="form-search" action="<?php echo SITE_BASE; ?>/inbox" method="post" onsubmit="$.blockUI();">
  <div class="controls">
    <div class="input-append">
    <input name="destre" type="hidden" value="<?php echo $mail->getSender(); ?>" />
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
$javascripts = array('jquery-1.7.1.min', 'jquery.blockui.min', 'bootstrap.min', 'hide-broken-images','mail/inbox','jquery.fancybox-1.3.4.pack', 'jquery.easing-1.3.pack', 'jquery.mousewheel-3.0.4.pack');
    
include(__DIR__ . '/../layout/footer.php');
