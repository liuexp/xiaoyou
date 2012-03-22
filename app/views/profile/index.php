<?php
$title = '花名册';
$no_sidebar = true;
$stylesheets = array('profiles');
include(__DIR__ . '/../layout/header.php');
?>
<h1>花名册</h1>
<?php foreach ($this->start_years as $start_year): ?>
  <section class="grade">
    <h2><?php echo $start_year; ?>级（<?php echo $this->class_number_map[$start_year]; ?>）</h2>
    <ul class="registered">
      <?php foreach ($this->students_map[$start_year] as $student): ?>
        <?php if (UserHelper::isRegistered($this->all_profiles, $student)): ?>
          <li>
            <?php
              $profileId = UserHelper::getStudentProfileId($this->all_profiles, $student);
              $username = UserHelper::getNameByProfileId($profileId);
              $avatarfile = AVATAR_DIR . $username . '-mini.jpg';
            ?>
            <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $profileId; ?>">
              <?php if (file_exists($avatarfile)): ?>
                <img src="<?php echo AVATAR_BASE; ?>/<?php echo $username; ?>-mini.jpg" width="40px" height="40px"/>
              <?php else: ?>
                <img src="<?php echo SITE_BASE; ?>/images/avatar-40.png" width="40px" height="40px"/>
              <?php endif; ?>
            </a>
            <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $profileId; ?>"><?php echo $student->getRealname(); ?></a>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
    <p class="clear"></p>
    <ul class="unregistered">
      <?php foreach ($this->students_map[$start_year] as $student): ?>
        <?php if (!UserHelper::isRegistered($this->all_profiles, $student)): ?>
          <li><?php echo $student->getRealname(); ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
    <p class="clear"></p>
  </section>
<?php endforeach; ?>
<?php
include(__DIR__ . '/../layout/footer.php');
