<?php
$title = $this->profile->getDisplayName();
$stylesheets = array('bootstrap.min', 'jquery.fancybox-1.3.4', 'profile');
$active=$this->active;
include(__DIR__ . '/../layout/header.php');
?>
<div class="tabbable" id="profile-tab">
  <ul class="nav nav-tabs">
<?php if ($active==0): ?>
    <li class="active">
<?php else: ?>
<li>
<?php endif; ?>
<a href="#tweets" data-toggle="tab">微博</a></li>

<?php if ($active==2): ?>
    <li class="active">
<?php else: ?>
<li>
<?php endif; ?>
    <a href="#msgs" data-toggle="tab">留言版</a></li>

  </ul>


  <div class="tab-content">
<?php if ($active==0): ?>
    <div class="tab-pane active" id="tweets">
<?php else: ?>
    <div class="tab-pane " id="tweets">
<?php endif; ?>
      <?php if ($this->is_owner): ?>
        <form class="well form-search w500" action="<?php echo SITE_BASE; ?>/tweets" method="post" onsubmit="$.blockUI();">
          <?php if ($tweet_success = fMessaging::retrieve('success', 'create tweet')): ?>
            <div class="alert alert-success fade in">
              <a class="close" data-dismiss="alert">&times;</a>
              <?php echo $tweet_success; ?>
            </div>
          <?php endif; ?>
          <?php if ($tweet_failure = fMessaging::retrieve('failure', 'create tweet')): ?>
            <div class="alert alert-error fade in">
              <a class="close" data-dismiss="alert">&times;</a>
              <?php echo $tweet_failure; ?>
            </div>
          <?php endif; ?>
          <div class="controls">
            <input name="tweet-content" type="text" class="input-xlarge input-btn-large" maxlength="140" placeholder="说点什么吧⋯⋯"/>
            <button type="submit" class="btn btn-danger btn-large btn-input-large">发表新微博</button>
          </div>
        </form>
      <?php endif; ?>
      <?php $tweets = $this->profile->getTweets(); ?>
      <?php if (count($tweets) && $this->is_allowed): ?>
        <ul class="unstyled">
          <?php foreach ($tweets as $tweet): ?>
            <li id="tweet/<?php echo $tweet->getId(); ?>">
              <blockquote class="tweet fade in well w500" data-tweet-id="<?php echo $tweet->getId(); ?>">
                <?php if ($this->editable): ?>
                  <a class="close" data-dismiss="alert">&times;</a>
                <?php endif; ?>
                <p><?php echo TweetHelper::replaceEmotion(htmlspecialchars($tweet->getContent())); ?></p>
                <small class="pull-right">发表于<?php echo $tweet->getTimestamp()->getFuzzyDifference(); ?>（<?php echo $tweet->getTimestamp(); ?>）</small>
                <p class="clear"></p>
                <?php include(__DIR__ . '/../tweet/_comments.php'); ?>
              </blockquote>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <div class="well w300 no-tweets">
          <p>
            <?php echo $this->profile->getDisplayName(); ?>还没有发表过微博<br/>
            可以先看看<?php echo $this->profile->getHeOrShe(); ?>的个人资料
          </p>
        </div>
      <?php endif; ?>
    </div>
<?php if ($active==2): ?>
    <div class="tab-pane active" id="msgs">
<?php else: ?>
    <div class="tab-pane " id="msgs">
<?php endif; ?>
        <form class="well form-search w500" action="<?php echo SITE_BASE; ?>/msgs" method="post" onsubmit="$.blockUI();">
          <?php if ($tweet_success = fMessaging::retrieve('success', 'create msg')): ?>
            <div class="alert alert-success fade in">
              <a class="close" data-dismiss="alert">&times;</a>
              <?php echo $tweet_success; ?>
            </div>
          <?php endif; ?>
          <?php if ($tweet_failure = fMessaging::retrieve('failure', 'create msg')): ?>
            <div class="alert alert-error fade in">
              <a class="close" data-dismiss="alert">&times;</a>
              <?php echo $tweet_failure; ?>
            </div>
          <?php endif; ?>
          <div class="controls">
    <input name="dest" type="hidden" value="<?php echo $this->profile->getId(); ?>" />
            <input name="msg-content" type="text" class="input-xlarge input-btn-large" maxlength="140" placeholder="说点什么吧⋯⋯"/>
            <button type="submit" class="btn btn-danger btn-large btn-input-large">发表新留言</button>
          </div>
        </form>
      <?php $tweets = $this->profile->getMsgs(); ?>
      <?php if (count($tweets) ): ?>
        <ul class="unstyled">
          <?php foreach ($tweets as $tweet): ?>
            <li id="msgs/<?php echo $tweet->getId(); ?>">
              <blockquote class="msgs fade in well w500" data-tweet-id="<?php echo $tweet->getId(); ?>">
                <?php if ($this->editable): ?>
                  <a class="close" data-dismiss="alert">&times;</a>
                <?php endif; ?>
                <p><?php echo TweetHelper::replaceEmotion(htmlspecialchars($tweet->getContent())); ?></p>
                <small class="pull-right"><?php $z=$tweet->getSendProfile();echo $z->getDisplayName(); ?>留言于<?php echo $tweet->getTimestamp()->getFuzzyDifference(); ?>（<?php echo $tweet->getTimestamp(); ?>）</small>
                <p class="clear"></p>
              </blockquote>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <div class="well w300 no-tweets">
          <p>
            <?php echo $this->profile->getDisplayName(); ?>还没有任何留言<br/>
            可以先看看<?php echo $this->profile->getHeOrShe(); ?>的个人资料
          </p>
        </div>
      <?php endif; ?>
    </div>
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
    <?php if ($this->is_owner): ?>
      <div class="mask"></div>
      <a id="edit-avatar-link" class="edit" href="#edit-avatar">编辑头像</a>
    <?php endif; ?>
  </div>
  <ul class="unstyled details">
<?php if ($this->is_allowed): ?>
    <li>
      入学年份：<?php echo $this->profile->getStartYear(); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <li>
      班级号：<?php echo $this->profile->getClassNumber(); ?>
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
      邮政编码：<?php echo htmlspecialchars($this->profile->getPostNumber()); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <li>
      工作领域：<?php echo htmlspecialchars(Util::getFieldName($this->profile->getField())); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <li>
      工作单位：<?php echo htmlspecialchars($this->profile->getInstitute()); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <li>
      职务：<?php echo htmlspecialchars($this->profile->getPosition()); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <li>
      在校学习专业：<?php echo htmlspecialchars($this->profile->getMajor()); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>
    <li>
      导师：<?php echo htmlspecialchars($this->profile->getMentor()); ?>
      <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
    </li>

    <li>
      隐私安全：<?php 
switch($this->profile->getPrivacyControl()){
case 0:
	echo "所有同学";
	break;
case 1:
	echo "相同年级";
	break;
case 2:
	echo "相同班级";
	break;
}
?>
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

    <?php foreach ($this->profile->getContacts() as $contact): ?>
      <?php if ($contact->getType() == 'msn'): ?>
        <li>
          MSN：<?php echo htmlspecialchars($contact->getContent()); ?>
          <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>


    <?php foreach ($this->profile->getContacts() as $contact): ?>
      <?php if ($contact->getType() == 'mobile'): ?>
        <li>
          移动电话：<?php echo htmlspecialchars($contact->getContent()); ?>
          <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>

    <?php foreach ($this->profile->getContacts() as $contact): ?>
      <?php if ($contact->getType() == 'tele'): ?>
        <li>
          固定电话：<?php echo htmlspecialchars($contact->getContent()); ?>
          <?php if ($this->editable): ?><div class="tools"><a class="edit" href="#edit-info"><img src="<?php echo SITE_BASE; ?>/images/icons/pencil.png"/></a></div><?php endif; ?>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>


  </ul>
  <ul class="unstyled contacts">
    <?php foreach ($this->profile->getContacts() as $contact): ?>
      <?php if ($contact->getType() == 'email'): ?>
        <!-- skip -->
      <?php elseif ($contact->getType() == 'mobile'): ?>
        <!-- skip -->
      <?php elseif ($contact->getType() == 'tele'): ?>
        <!-- skip -->
      <?php elseif ($contact->getType() == 'msn'): ?>
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

    <?php endif; ?>
  </ul>
</aside>
<?php if ($this->editable): ?>
<div style="display:none">
  <div id="edit-avatar" class="popup">
    <h2>编辑头像</h2>
    <form id="edit-avatar-form" class="form-horizontal" method="POST" action="<?php echo SITE_BASE; ?>/avatar/upload" enctype="multipart/form-data">
      <div class="field">
        <span class="label">请先选择一张照片上传：（只接受JPEG格式）</span><br/>
        <input type="file" id="avatar-file" name="avatar-file"/><br/>
        <span class="hint" style="display:block">（上传照片后，你可以选取照片的一部分作为头像）</span>
        <span style="color:red">请选择一张正面的、五官显式的、人像大些、清晰的近照上传</span>
      </div>
      <div class="failure" style="display:none"></div>
      <div class="action">
        <button type="submit" class="btn btn-success btn-large">
          <i class="icon-ok icon-white"></i>
          上传
        </button>
      </div>
      <p class="clear"></p>
    </form>
  </div>
  <div id="edit-info" class="popup">
    <h2>编辑个人信息</h2>
    <form id="edit-info-form" class="form-horizontal" method="POST" action="<?php echo SITE_BASE; ?>/profile/<?php echo $this->profile->getId(); ?>">
      <fieldset>
        <div class="field">
          <label for="start_year">入学年份：</label>
          <select id="start_year" name="start_year" class="input-mini">
            <?php for ($i = 2002; $i <= date('Y'); $i++): ?>
              <option value="<?php echo $i; ?>"<?php if ($i == $this->profile->getStartYear()) echo ' selected'; ?>><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="field">
          <label for="class_number">原班级号：</label>
          <input class="textfield monofont input-medium" type="text" id="class_number" name="class_number" maxlength="20" value="<?php echo htmlspecialchars($this->profile->getClassNumber()); ?>"/>
        </div>
	<div class="field">
        <label >隐私安全：</label>
          <input type="radio" name="privacy" value="0" id="privacy0"<?php if ($this->profile->getPrivacyControl()==0) echo ' checked'; ?>/><label class="radio2" for="privacy0">向所有同学公开</label>
          <input type="radio" name="privacy" value="1" id="privacy1"<?php if ($this->profile->getPrivacyControl()==1) echo ' checked'; ?>/><label class="radio2" for="privacy1">向相同年级同学公开</label>
          <input type="radio" name="privacy" value="2" id="privacy2"<?php if ($this->profile->getPrivacyControl()==2) echo ' checked'; ?>/><label class="radio2" for="privacy2">向同班同学公开</label>
      </div>

        <div class="field">
          <label for="birthday">生日：</label>
          <input class="textfield monofont Wdate input-medium" type="text" id="birthday" name="birthday" maxlength="10" onclick="WdatePicker()" value="<?php echo htmlspecialchars($this->profile->getBirthday()); ?>"/>
          <label class="small">性别：</label>
          <input type="radio" name="gender" value="M" id="genderM"<?php if ($this->profile->isMale()) echo ' checked'; ?>/><label class="radio" for="genderM">男</label>
          <input type="radio" name="gender" value="F" id="genderF"<?php if (!$this->profile->isMale()) echo ' checked'; ?>/><label class="radio" for="genderF">女</label>
        </div>
        <div class="field">
          <label for="location">现居住地：</label>
          <input class="textfield monofont input-medium" type="text" id="location" name="location" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getLocation()); ?>"/>
        <label for="post_number">邮政编码：</label>
          <input class="textfield monofont input-medium" type="text" id="post_number" name="post_number" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getPostNumber()); ?>"/>

        </div>
         <div class="field">
          <label for="field">工作领域：</label>
        <select id="field" name="field" style="width: 160px;">
          <option value="<?php echo htmlspecialchars($this->profile->getField()); ?>"></option>
<?php $i=1;while (Util::getFieldName($i) != $i ): ?>
<option value="<?php echo $i; ?>"> <?php echo Util::getFieldName($i++); ?> </option>
<?php endwhile; ?>
        </select>
        <label for="institute">工作单位：</label>
          <input class="textfield monofont input-medium" type="text" id="institute" name="institute" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getInstitute()); ?>"/>

        </div>
         <div class="field">
          <label for="position">职务：</label>
          <input class="textfield monofont input-medium" type="text" id="position" name="position" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getPosition()); ?>"/>
        <label for="major">在校学习专业：</label>
          <input class="textfield monofont input-medium" type="text" id="major" name="major" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getMajor()); ?>"/>

        </div>
      </fieldset>
      <fieldset>
        <div class="field">
        <label for="mentor">导师：</label>
          <input class="textfield monofont input-medium" type="text" id="mentor" name="mentor" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getMentor()); ?>"/>

          <label for="msn">MSN：</label>
          <input class="textfield monofont input-medium" type="text" id="msn" name="msn" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('msn')); ?>"/>
	</div>
 
        <div class="field">
          <label for="tele">固定电话：</label>
          <input class="textfield monofont input-medium" type="text" id="tele" name="tele" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('tele')); ?>"/>

          <label for="mobile" >移动电话：</label>
          <input class="textfield monofont input-medium" type="text" id="mobile" name="mobile" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('mobile')); ?>"/>
        </div>

        <div class="field">
          <label for="email">常用Email：</label>
          <input class="textfield monofont input-medium" type="text" id="email" name="email" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('email')); ?>"/>

          <label for="qq" >QQ：</label>
          <input class="textfield monofont input-medium" type="text" id="qq" name="qq" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('qq')); ?>"/>
        </div>
        <div class="field">
          <label for="renren">人人网主页地址：</label>
          <input class="textfield monofont input-xlarge" type="text" id="renren" name="renren" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('renren')); ?>"/>
        </div>
        <div class="field">
          <label for="weibo">新浪微博ID：</label>
          <input class="textfield monofont input-small" type="text" id="weibo" name="weibo" maxlength="200" value="<?php echo htmlspecialchars($this->profile->getContactOrEmpty('weibo')); ?>"/>
        </div>
        </fieldset>
	<div class="field">
        <label for="subscription">希望校友频道提供</label>
        <select id="subscription" name="subscription">
          <option value="<?php echo htmlspecialchars($this->profile->getSubscription()); ?>"></option>
          <option value=1>校友刊物</option>
          <option value=2>校友信息</option>
          <option value=3>学术研讨会信息</option>
          <option value=4>相关法律出版物目录</option>
        </select>
      </div>

      <div class="failure" style="display:none"></div>
      <div class="action">
        <button type="submit" class="btn btn-success btn-large">保存</button>
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
    'jquery.blockui.min','bootstrap.min',
    'jquery.fancybox-1.3.4.pack', 'jquery.easing-1.3.pack', 'jquery.mousewheel-3.0.4.pack',
    'profile/show.min',
    'hide-broken-images'
  );
} else {
  $javascripts = array( 'bootstrap.min','jquery.blockui.min', 'hide-broken-images');
}
include(__DIR__ . '/../layout/footer.php');
