<?php
$title = $this->profile->getDisplayName();
$stylesheets = array('bootstrap.min', 'jquery.fancybox-1.3.4', 'profile');
include(__DIR__ . '/../layout/header.php');
?>
<div class="tabbable" id="profile-tab">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tweets" data-toggle="tab">微博</a></li>
    <li><a href="#profile" data-toggle="tab">资料</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tweets">
      <p>I'm in Section 1.</p>
    </div>
    <div class="tab-pane" id="profile">
<!-- begin main content -->
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
          <?php echo htmlspecialchars($experience->getLocation()); ?>.
          专业/方向：<?php echo htmlspecialchars($experience->getMajor()); ?>.
          <?php if (strlen($experience->getMentor())): ?>
            导师：<?php echo htmlspecialchars($experience->getMentor()); ?>
          <?php endif; ?>
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
          <?php echo htmlspecialchars($paper->getAuthors()); ?>.
          <?php echo htmlspecialchars($paper->getTitle()); ?>.
          <?php echo htmlspecialchars($paper->getPublishPlace()); ?>.
          <?php if ($paper->getIsBestPaper()): ?>（最佳论文）<?php endif; ?>
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
          <?php echo htmlspecialchars($honor->getDescription()); ?>
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
<!-- end main content -->
    </div><!-- /.tab-pane -->
  </div><!-- /.tab-content -->
</div><!-- /.tabbable -->
<aside class="profile">
  <h1>
    <?php echo htmlspecialchars($this->profile->getDisplayName()); ?>
    <?php if ($this->profile->isMale()): ?>
      <img class="gender" src="<?php echo SITE_BASE; ?>/images/male-gender-sign.gif"/>
    <?php else: ?>
      <img class="gender" src="<?php echo SITE_BASE; ?>/images/female-gender-sign.gif"/>
    <?php endif; ?>
  </h1>
  <div class="avainfo">
    <?php if (file_exists($this->avatarfile)): ?>
      <img class="avatar" src="<?php echo AVATAR_BASE; ?>/<?php echo $this->username; ?>-avatar.jpg">
    <?php else: ?>
      <img class="avatar" src="<?php echo SITE_BASE; ?>/images/default-avatar.jpg"/>
    <?php endif; ?>
    <?php if ($this->editable): ?>
      <div class="mask"></div>
      <a id="edit-avatar-link" class="edit" href="#edit-avatar">编辑头像</a>
    <?php endif; ?>
  </div>
  <ul class="details">
    <li>
      入学年份：<?php echo $this->profile->getStartYear(); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <li>
      生日：<?php echo $this->profile->getBirthday(); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <li>
      现居住地：<?php echo htmlspecialchars($this->profile->getLocation()); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <li>
      家乡：<?php echo htmlspecialchars($this->profile->getHometown()); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <li>
      高中：<?php echo htmlspecialchars($this->profile->getHighSchool()); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <?php foreach ($this->profile->getContacts() as $contact): ?>
      <?php if ($contact->getType() == 'email'): ?>
        <li>
          Email：<?php echo htmlspecialchars($contact->getContent()); ?>
          <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
  <ul class="contacts">
    <?php foreach ($this->profile->getContacts() as $contact): ?>
      <?php if ($contact->getType() == 'email'): ?>
        <!-- skip -->
      <?php elseif ($contact->getType() == 'qq'): ?>
        <li>
          <a class="qq" target="_blank" href="http://<?php echo htmlspecialchars($contact->getContent()); ?>.qzone.qq.com/">
            <img title="<?php echo htmlspecialchars($contact->getContent()); ?>" src="<?php echo SITE_BASE; ?>/images/32-qq.png"/>
          </a>
        </li>
      <?php elseif ($contact->getType() == 'weibo'): ?>
        <li>
          <a class="weibo" target="_blank" href="http://weibo.com/<?php echo htmlspecialchars($contact->getContent()); ?>">
            <img title="<?php echo htmlspecialchars($contact->getContent()); ?>" src="<?php echo SITE_BASE; ?>/images/32-weibo.png"/>
          </a>
        </li>
      <?php elseif ($contact->getType() == 'douban'): ?>
        <li>
          <a class="douban" target="_blank" href="http://www.douban.com/people/<?php echo htmlspecialchars($contact->getContent()); ?>/">
            <img title="<?php echo htmlspecialchars($contact->getContent()); ?>" src="<?php echo SITE_BASE; ?>/images/32-douban.png"/>
          </a>
        </li>
      <?php elseif ($contact->getType() == 'twitter'): ?>
        <li>
          <a class="twitter" target="_blank" href="http://twitter.com/<?php echo htmlspecialchars($contact->getContent()); ?>">
            <img title="<?php echo htmlspecialchars($contact->getContent()); ?>" src="<?php echo SITE_BASE; ?>/images/32-twitter.png"/>
          </a>
        </li>
      <?php else: ?>
        <li>
          <a class="other" target="_blank" href="<?php echo Util::ensurePrefix('http://', $contact->getContent()); ?>">
            <img src="<?php echo SITE_BASE; ?>/images/32-<?php echo $contact->getType(); ?>.png"/>
          </a>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</aside>
<?php if ($this->editable): ?>
<div style="display:none">
  <div id="edit-avatar" class="popup">
    <h2>编辑头像</h2>
    <form id="edit-avatar-form" method="POST" action="<?php echo SITE_BASE; ?>/avatar/upload" enctype="multipart/form-data">
      <div class="field">
        <span class="label">请先选择一张照片上传：（只接受JPEG格式）</span><br/>
        <input type="file" id="avatar-file" name="avatar-file"/><br/>
        <span class="hint" style="display:block">（上传照片后，你可以选取照片的一部分作为头像）</span>
        <span style="color:red">请选择一张正面的、五官显式的、人像大些、清晰的近照上传</span>
      </div>
      <div class="failure" style="display:none"></div>
      <div class="action">
        <button type="submit" class="classy primary" data-afterclick="正在上传⋯⋯">
          <span>上传</span>
        </button>
      </div>
      <p class="clear"></p>
    </form>
  </div>
  <div id="edit-info" class="popup">
    <h2>编辑个人信息</h2>
    <form id="edit-info-form" method="POST" action="<?php echo SITE_BASE; ?>/profile/<?php echo $this->profile->getId(); ?>">
      <fieldset>
        <div class="field">
          <label for="start_year">入学年份：</label>
          <select id="start_year" name="start_year">
            <?php for ($i = 2002; $i <= date('Y'); $i++): ?>
              <option value="<?php echo $i; ?>"<?php if ($i == $this->profile->getStartYear()) echo ' selected'; ?>><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="field">
          <label for="student_number">本科学号：</label>
          <input class="textfield monofont" type="text" id="student_number" name="student_number" maxlength="20" value="<?php echo htmlspecialchars($this->profile->getStudentNumber()); ?>"/>
        </div>
        <div class="field">
          <label for="birthday">生日：</label>
          <input class="textfield monofont Wdate" type="text" id="birthday" name="birthday" maxlength="10" onclick="WdatePicker()" value="<?php echo htmlspecialchars($this->profile->getBirthday()); ?>"/>
        </div>
        <div class="field">
          <label>性别：</label>
          <input type="radio" name="gender" value="M" id="genderM"<?php if ($this->profile->isMale()) echo ' checked'; ?>/><label class="radio" for="genderM">男</label>
          <input type="radio" name="gender" value="F" id="genderF"<?php if (!$this->profile->isMale()) echo ' checked'; ?>/><label class="radio" for="genderF">女</label>
        </div>
        <div class="field">
          <label for="location">现居住地：</label>
          <input class="textfield monofont" type="text" id="location" name="location" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getLocation()); ?>"/>
        </div>
        <div class="field">
          <label for="hometown">家乡：</label>
          <input class="textfield monofont" type="text" id="hometown" name="hometown" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getHometown()); ?>"/>
        </div>
        <div class="field">
          <label for="high_school">高中：</label>
          <input class="textfield monofont" type="text" id="high_school" name="high_school" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getHighSchool()); ?>"/>
        </div>
      </fieldset>
      <fieldset>
        <div class="field">
          <label for="email">常用Email：</label>
          <input class="textfield monofont" type="text" id="email" name="email" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('email')); ?>"/>
        </div>
        <div class="field">
          <label for="qq">QQ：</label>
          <input class="textfield monofont" type="text" id="qq" name="qq" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('qq')); ?>"/>
        </div>
        <div class="field">
          <label for="renren">人人网主页地址：</label>
          <input class="textfield monofont" type="text" id="renren" name="renren" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('renren')); ?>"/>
        </div>
        <div class="field">
          <label for="weibo">新浪微博ID：</label>
          <input class="textfield monofont" type="text" id="weibo" name="weibo" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('weibo')); ?>"/>
        </div>
        <div class="field">
          <label for="douban">豆瓣ID：</label>
          <input class="textfield monofont" type="text" id="douban" name="douban" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('douban')); ?>"/>
        </div>
        <div class="field">
          <label for="facebook">Facebook主页地址：</label>
          <input class="textfield monofont" type="text" id="facebook" name="facebook" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('facebook')); ?>"/>
        </div>
        <div class="field">
          <label for="twitter">Twitter ID：</label>
          <input class="textfield monofont" type="text" id="twitter" name="twitter" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('twitter')); ?>"/>
        </div>
      </fieldset>
      <div class="failure" style="display:none"></div>
      <div class="action">
        <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
          <span>保存</span>
        </button>
      </div>
      <p class="clear"></p>
    </form>
  </div>
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
<script type="text/javascript">
  window.profileId = '<?php echo $this->profile->getId(); ?>';
<?php if ($failure = fMessaging::retrieve('failure', 'upload avatar')): ?>
  window.uploadAvatar = { result: 'failure', message: '<?php echo $failure; ?>' };
<?php else: ?>
  window.uploadAvatar = { result: 'success' };
<?php endif; ?>
</script>
<?php endif; ?>
<?php
if ($this->editable) {
  $javascripts = array(
    'datepicker/WdatePicker',
    'jquery-1.7.1.min',
    'jquery.fancybox-1.3.4.pack', 'jquery.easing-1.3.pack', 'jquery.mousewheel-3.0.4.pack',
    'profile/show.min',
    'bootstrap.min'
  );
} else {
  $javascripts = array('jquery-1.7.1.min', 'bootstrap.min');
}
include(__DIR__ . '/../layout/footer.php');
