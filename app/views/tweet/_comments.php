<?php foreach ($tweet->getComments() as $comment): ?>
  <?php $replier = $comment->getProfile(); ?>
  <blockquote data-tweet-comment-id="<?php echo $comment->getId(); ?>">
    <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $replier->getId(); ?>"><?php echo $replier->getDisplayName(); ?></a>
    <span>:</span>
    <span><?php echo TweetHelper::replaceEmotion(htmlspecialchars($comment->getContent())); ?></span>
    <small><?php echo $comment->getTimestamp()->getFuzzyDifference(); ?></small>
  </blockquote>
<?php endforeach; ?>
<?php if (fAuthorization::checkLoggedIn()): ?>
<form class="form-search" action="<?php echo SITE_BASE; ?>/tweet/<?php echo $tweet->getId(); ?>/reply" method="post">
  <div class="controls">
    <div class="input-append">
      <input name="tweet-comment" type="text" class="input-xlarge" maxlength="140" placeholder="这里输入回复内容"/>
      <button type="submit" class="btn btn-success btn-small">添加回复</button>
    </div>
  </div>
</form>
<?php endif; ?>