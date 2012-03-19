<?php
$title = $this->profile->getDisplayName();
$stylesheets = array('profile');
include(__DIR__ . '/../layout/header.php');
?>
<section>
  <section>
    <h2>经历</h2>
    <ul>
      <?php foreach ($this->profile->getExperiences() as $experience): ?>
        <li>
          <?php echo $experience->getFormattedTimePeriod(); ?>.
          <?php echo $experience->getLocation(); ?>,
          <?php echo $experience->getDescription(); ?>.
        </lii>
      <?php endforeach; ?>
    </ul>
  </section>
  <section>
    <h2>论文</h2>
    <ul>
      <?php foreach ($this->profile->getPapers() as $paper): ?>
        <li>
          <?php echo $paper->getPublishYear(); ?>.
          <?php echo $paper->getAuthors(); ?>.
          <?php echo $paper->getTitle(); ?>.
          <?php echo $paper->getPublishPlace(); ?>.
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
  <section>
    <h2>荣誉</h2>
    <ul>
      <?php foreach ($this->profile->getHonors() as $honor): ?>
        <li>
          <?php echo $honor->getFormattedDate(); ?>.
          <?php echo $honor->getDescription(); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
</section>
<aside class="profile">
  <h1>
    <?php echo $this->profile->getDisplayName(); ?>
    <?php if ($this->profile->isMale()): ?>
      <img class="gender" src="<?php echo SITE_BASE; ?>/images/male-gender-sign.png"/>
    <?php else: ?>
      <img class="gender" src="<?php echo SITE_BASE; ?>/images/female-gender-sign.png"/>
    <?php endif; ?>
  </h1>
  <img class="avatar" src="<?php echo SITE_BASE; ?>/images/default-avatar.png"/>
  <ul>
    <li>入学年份：<?php echo $this->profile->getStartYear(); ?></li>
    <li>生日：<?php echo $this->profile->getBirthday(); ?></li>
    <li>现居住地：<?php echo $this->profile->getLocation(); ?></li>
    <li>家乡：<?php echo $this->profile->getHometown(); ?></li>
    <li>自我描述：<?php echo $this->profile->getDescription(); ?></li>
    <!-- TODO list contacts here -->
  </ul>
</aside>
<?php
include(__DIR__ . '/../layout/footer.php');
