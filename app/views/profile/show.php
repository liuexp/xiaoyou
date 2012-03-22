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
          <?php echo $experience->getFormattedType(); ?>.
          <?php echo $experience->getLocation(); ?>.
          <?php echo $experience->getMajor(); ?>.
          <?php echo $experience->getMentor(); ?>
          <?php if ($this->editable): ?>
            <div class="tools">
              <a class="edit edit-experience" href="<?php echo SITE_BASE; ?>/experience/<?php echo $experience->getId(); ?>/edit">
                <img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/>
              </a>
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
              <a class="edit edit-paper" href="<?php echo SITE_BASE; ?>/paper/<?php echo $paper->getId(); ?>/edit">
                <img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/>
              </a>
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
              <a class="edit edit-honor" href="<?php echo SITE_BASE; ?>/honor/<?php echo $honor->getId(); ?>/edit">
                <img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/>
              </a>
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
  <ul class="details">
    <li>入学年份：<?php echo $this->profile->getStartYear(); ?></li>
    <li>生日：<?php echo $this->profile->getBirthday(); ?></li>
    <li>现居住地：<?php echo $this->profile->getLocation(); ?></li>
    <li>家乡：<?php echo $this->profile->getHometown(); ?></li>
    <li>高中：<?php echo $this->profile->getHighSchool(); ?></li>
    <li>在校期间印象最深的一件事：<?php echo $this->profile->getMemorable(); ?></li>
    <li>离校后这几年的简单经历：<?php echo $this->profile->getDescription(); ?></li>
    <?php foreach ($this->profile->getContacts() as $contact): ?>
      <?php if ($contact->getType() == 'email'): ?>
        <li>Email：<?php echo $contact->getContent(); ?></li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
  <ul class="contacts">
    <?php foreach ($this->profile->getContacts() as $contact): ?>
      <?php if ($contact->getType() == 'email'): ?>
        <!-- skip -->
      <?php elseif ($contact->getType() == 'qq'): ?>
        <li>
          <a class="qq" href="#" data-qq="<?php echo $contact->getContent(); ?>">
            <img title="<?php echo $contact->getContent(); ?>" src="<?php echo SITE_BASE; ?>/images/32-qq.png"/>
          </a>
        </li>
      <?php else: ?>
        <li>
          <a class="other" target="_blank" href="<?php echo $contact->getContent(); ?>">
            <img src="<?php echo SITE_BASE; ?>/images/32-<?php echo $contact->getType(); ?>.png"/>
          </a>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</aside>
<div style="display:none">
  <div id="add-experience" class="popup">
    <h2>添加经历</h2>
    <form id="add-experience-form" method="POST" action="<?php echo SITE_BASE; ?>/experiences">
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
        <label>类型：</label>
        <select name="type">
          <option value=""></option>
          <option value="bachelor">本科</option>
          <option value="master">硕士</option>
          <option value="doctor">博士</option>
          <option value="postdoc">博士后</option>
          <option value="work">工作</option>
        </select>
      </div>
      <div class="field">
        <label>学校/单位：</label>
        <input type="text" name="location" maxlength="200"/>
      </div>
      <div class="field">
        <label>专业/方向：</label>
        <input type="text" name="major" maxlength="200"/>
      </div>
      <div class="field">
        <label>导师：</label>
        <input type="text" name="mentor" maxlength="200"/>
      </div>
      <div class="failure" style="display:none"></div>
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
    <form id="add-paper-form" class="longlabel" method="POST" action="<?php echo SITE_BASE; ?>/papers">
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
        <label>是否在交大期间发表：</label>
        <input type="checkbox" name="is_at_sjtu"/>
      </div>
      <div class="field">
        <label>是否最佳论文：</label>
        <input type="checkbox" name="is_best_paper"/>
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
      <div class="failure" style="display:none"></div>
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
    <form id="add-honor-form" method="POST" action="<?php echo SITE_BASE; ?>/honors">
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
      <div class="failure" style="display:none"></div>
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
