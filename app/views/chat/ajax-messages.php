<div class="messages message-list">
<?php foreach (array_reverse($this->messages) as $message): ?>
  <article class="a-feed">
    <aside>
      <figure>
        <a target="_blank" href="<?php echo SITE_BASE; ?>/profile/<?php echo $message->profileId; ?>">
          <?php if (file_exists(AVATAR_DIR . $message->loginName . '-mini.jpg')): ?>
            <img src="<?php echo AVATAR_BASE; ?>/<?php echo $message->loginName; ?>-mini.jpg" width="40px" height="40px"/>
          <?php else: ?>
            <img src="<?php echo SITE_BASE; ?>/images/avatar-40.jpg" width="40px" height="40px"/>
          <?php endif; ?>
        </a>
      </figure>
    </aside>
    <h3>
      <a target="_blank" href="<?php echo SITE_BASE; ?>/profile/<?php echo $message->profileId; ?>"><?php echo $message->displayName; ?></a>
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