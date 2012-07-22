<?php
$title = '找人';
$no_sidebar = true;
$stylesheets = array('bootstrap.min', 'tweets');
include(__DIR__ . '/../layout/header.php');
?>
<div class="timeline feed-list">
  <?php if (fAuthorization::checkLoggedIn()): ?>
  <center>
    <form class="well form-search w500" action="<?php echo SITE_BASE; ?>/search" method="post" onsubmit="$.blockUI();">
      <input type="hidden" name="quick" value="true"/>
      <div class="controls">
        <select id="field" name="field" style="width:110px;">
          <option value="">工作领域:</option>
<?php $i=1;while (Util::getFieldName($i) != $i ): ?>
<option value="<?php echo $i; ?>"> <?php echo Util::getFieldName($i++); ?> </option>
<?php endwhile; ?>
        </select>
      <select id="start_year" name="start_year" style="width:85px;">
          <option value="">入学年份</option>
          <?php for ($i = 1901; $i <= date('Y'); $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
        <input name="major" type="text" maxlength="140" placeholder="在校专业" style="width:100px;"/>
        <input name="location" type="text" maxlength="140" placeholder="现工作地区" style="width:100px;"/>
        <input name="words" type="text" class="input-xlarge" maxlength="140" placeholder="搜索用户、人名"/>
        <button type="submit" class="btn btn-danger btn-large">找人</button>
      </div>
    </form>
  </center>
<?php if ($this->editable): ?>
    <form class="form-search w500" action="<?php echo SITE_BASE; ?>/manage/sendmail" method="post" onsubmit="$.blockUI();">
<!-- <a class="btn btn-primary" href="#"><font color="#FFF">给下列用户群发邮件</font></a> -->
<input id="field" name="field" type="hidden" value="<?php echo $this->field; ?>">
<input id="start_year" name="start_year" type="hidden" value="<?php echo $this->start_year; ?>">
<input id="major" name="major" type="hidden" value="<?php echo $this->major; ?>">
<input id="location" name="location" type="hidden" value="<?php echo $this->location; ?>">
<input id="words" name="words" type="hidden" value="<?php echo $this->words; ?>">
        <button type="submit" class="btn btn-danger btn-large">给下列用户群发邮件</button>
<?php endif; ?>
  <?php endif; ?>
<?php if (isset($this->users)): ?>
<?php foreach ($this->users as $profile): ?>
  <?php
    $username = $profile->getLoginName();
    $avatarfile = AVATAR_DIR . $username . '-mini.jpg';
    $isAllowed=UserHelper::viewProfile($profile);
  ?>
  <article class="a-feed" id="user-<?php echo $profile->getId(); ?>">
    <aside>
      <figure>
<?php if ($isAllowed): ?>
        <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $profile->getId(); ?>">
<?php endif; ?>
          <?php if (file_exists($avatarfile)): ?>
            <img src="<?php echo AVATAR_BASE; ?>/<?php echo $username; ?>-mini.jpg" width="40px" height="40px"/>
          <?php else: ?>
            <img src="<?php echo SITE_BASE; ?>/images/avatar-40.jpg" width="40px" height="40px"/>
          <?php endif; ?>

<?php if ($isAllowed): ?>
        </a>
<?php endif; ?>
      </figure>
    </aside>
    <h3>
<?php if ($isAllowed): ?>
      <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $profile->getId(); ?>">
<?php endif; ?>
<?php echo htmlspecialchars($profile->getDisplayName()); ?>
<?php if ($isAllowed): ?>
</a>
<?php endif; ?>
      <span>:</span>
	      <span><?php echo "领域:".Util::getFieldName($profile->getField()).";  单位:".$profile->getInstitute().";  职务:".$profile->getPosition();?>  </span>
    </h3>
    <div class="details">
      <div class="legend">
        <span >现居住地:</span>
	<span>  <?php echo $profile->getLocation(); ?></span>
      </div>
    </div>
  </article>
<?php endforeach; ?>
<?php endif; ?>
</div>
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.blockui.min', 'bootstrap.min', 'hide-broken-images');
include(__DIR__ . '/../layout/footer.php');
