<?php
$title = $this->profile->getDisplayName();
$stylesheets = array('jquery.fancybox-1.3.4', 'profile');
include(__DIR__ . '/../layout/header.php');
?>
<section>
  <section>
    <h2>
      经历
      <?php if ($this->editable): ?>
        <a class="add" href="#add-experience"><img src="<?php echo SITE_BASE; ?>/images/icons/add.png"/></a>
      <?php endif; ?>
    </h2>
    <ul class="relation-list">
      <?php foreach ($this->profile->getExperiences() as $experience): ?>
        <li data-experience-id="<?php echo $experience->getId(); ?>">
          <?php echo $experience->getFormattedTimePeriod(); ?>.
          <?php echo $experience->getLocation(); ?>,
          <?php echo $experience->getDescription(); ?>.
          <?php if ($this->editable): ?>
            <div class="tools">
              <a class="edit edit-experience" href="#"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a>
              <a class="delete delete-experience" href="#"><img src="<?php echo SITE_BASE; ?>/images/icons/delete.png"/></a>
            </div>
          <?php endif; ?>
        </lii>
      <?php endforeach; ?>
    </ul>
  </section>
  <section>
    <h2>
      论文
      <?php if ($this->editable): ?>
        <a class="add" href="#add-paper"><img src="<?php echo SITE_BASE; ?>/images/icons/add.png"/></a>
      <?php endif; ?>
    </h2>
    <ul class="relation-list">
      <?php foreach ($this->profile->getPapers() as $paper): ?>
        <li data-paper-id="<?php echo $paper->getId(); ?>">
          <?php echo $paper->getPublishYear(); ?>.
          <?php echo $paper->getAuthors(); ?>.
          <?php echo $paper->getTitle(); ?>.
          <?php echo $paper->getPublishPlace(); ?>.
          <?php if ($this->editable): ?>
            <div class="tools">
              <a class="edit edit-paper" href="#"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a>
              <a class="delete delete-paper" href="#"><img src="<?php echo SITE_BASE; ?>/images/icons/delete.png"/></a>
            </div>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
  <section>
    <h2>
      荣誉
      <?php if ($this->editable): ?>
        <a class="add" href="#add-honor"><img src="<?php echo SITE_BASE; ?>/images/icons/add.png"/></a>
      <?php endif; ?>
    </h2>
    <ul class="relation-list">
      <?php foreach ($this->profile->getHonors() as $honor): ?>
        <li data-honor-id="<?php echo $honor->getId(); ?>">
          <?php echo $honor->getFormattedDate(); ?>.
          <?php echo $honor->getDescription(); ?>
          <?php if ($this->editable): ?>
            <div class="tools">
              <a class="edit edit-honor" href="#"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a>
              <a class="delete delete-honor" href="#"><img src="<?php echo SITE_BASE; ?>/images/icons/delete.png"/></a>
            </div>
          <?php endif; ?>
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
<div style="display:none">
  <div id="add-experience" class="popup">
    <h2>添加经历</h2>
    <form method="POST" action="<?php echo SITE_BASE; ?>/experiences">
      <div class="field">
        <label>开始年月：</label>
        <select name="start_year">
          <?php for ($i = 2002; $i <= Util::currentYear(); $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>年
        <select name="start_month">
          <option value=""></option>
          <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>月
      </div>
      <div class="field">
        <label>结束年月：</label>
        <select name="end_year">
          <option value="">至今</option>
          <?php for ($i = 2002; $i <= Util::currentYear(); $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>年
        <select name="end_month">
          <option value=""></option>
          <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>月
      </div>
      <div class="field">
        <label>地点：</label>
        <input type="text" name="location" maxlength="200"/>
      </div>
      <div class="field">
        <label>描述：</label>
        <input type="text" name="description" maxlength="200"/>
      </div>
      <div class="action">
        <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
          <span>提交</span>
        </button>
      </div>
      <p class="clear"></p>
    </form>
  </div>
  <div id="add-paper" class="popup">
    <h2>添加论文</h2>
    <form method="POST" action="<?php echo SITE_BASE; ?>/papers">
      <div class="field">
        <label>标题：</label>
        <input type="text" name="title" maxlength="200"/>
      </div>
      <div class="field">
        <label>作者列表：</label>
        <input type="text" name="authors" maxlength="200"/>
      </div>
      <div class="field">
        <label>是否第一作者：</label>
        <input type="checkbox" name="is_first_author"/>
      </div>
      <div class="field">
        <label>发表在：</label>
        <input type="text" name="publish_place" maxlength="200"/>
      </div>
      <div class="field">
        <label>发表年份：</label>
        <select name="publish_year">
          <?php for ($i = 2002; $i <= Util::currentYear(); $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="action">
        <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
          <span>提交</span>
        </button>
      </div>
      <p class="clear"></p>
    </form>
  </div>
  <div id="add-honor" class="popup">
    <h2>添加荣誉</h2>
    <form method="POST" action="<?php echo SITE_BASE; ?>/honors">
      <div class="field">
        <label>获得荣誉年月：</label>
        <select name="year">
          <?php for ($i = 2002; $i <= Util::currentYear(); $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>年
        <select name="month">
          <option value=""></option>
          <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>月
      </div>
      <div class="field">
        <label>描述：</label>
        <input type="text" name="description" maxlength="200"/>
      </div>
      <div class="action">
        <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
          <span>提交</span>
        </button>
      </div>
      <p class="clear"></p>
    </form>
  </div>
</div>
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.fancybox-1.3.4.pack', 'jquery.easing-1.3.pack', 'jquery.mousewheel-3.0.4.pack', 'profile/show');
include(__DIR__ . '/../layout/footer.php');
