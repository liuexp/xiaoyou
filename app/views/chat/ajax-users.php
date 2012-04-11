<div class="users user-list">
  <h2>在线用户</h2>
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