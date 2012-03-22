<?php
$title = '创建个人信息';
$stylesheets = array('new-profile');
include(__DIR__ . '/../layout/header.php');
?>
<section>
  <h1>创建个人信息</h1>
  <form id="new-profile" method="POST" action="<?php echo SITE_BASE; ?>/profiles">
    <fieldset>
      <legend>基本信息</legend>
      <blockquote>
        <p class="prolog">
          浮云游子意，落日故人情<br/>
          亲爱的ACM班大家庭成员，欢迎回家<br/>
          适十周年庆典之际，以此问卷，了解故人近况<br/>
          以借此机会收集大家的信息，以便更密切的联系
        </p>
      </blockquote>
      <div class="field">
        <label for="start_year">入学年份：</label>
        <select id="start_year" name="start_year">
          <option></option>
          <?php for ($i = 2002; $i <= date('Y'); $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="field">
        <label for="student_number">学号：</label>
        <input class="textfield monofont" type="text" id="student_number" name="student_number" maxlength="20"/>
      </div>
      <div class="field">
        <label for="birthday">生日：</label>
        <input class="textfield monofont Wdate" type="text" id="birthday" name="birthday" maxlength="10" onclick="WdatePicker()"/>
      </div>
      <div class="field">
        <label>性别：</label>
        <input type="radio" name="gender" value="M" id="genderM"/><label class="radio" for="genderM">男</label>
        <input type="radio" name="gender" value="F" id="genderF"/><label class="radio" for="genderF">女</label>
      </div>
      <div class="field">
        <label for="location">现居住地：</label>
        <input class="textfield monofont" type="text" id="location" name="location" maxlength="200"/>
      </div>
      <div class="field">
        <label for="hometown">家乡：</label>
        <input class="textfield monofont" type="text" id="hometown" name="hometown" maxlength="200"/>
      </div>
      <div class="field">
        <label for="high_school">高中：</label>
        <input class="textfield monofont" type="text" id="high_school" name="high_school" maxlength="200"/>
      </div>
    </fieldset>
    <fieldset>
      <legend>故情·近况</legend>
      <blockquote>
        <p class="prolog">
          惜我往矣，杨柳依依，今我来思，雨雪霏霏<br/>
          相别数年，不知故人可好？
        </p>
      </blockquote>
      <div class="field">
        <span class="label">回忆你在校期间印象最深的一件事</span>
        <textarea id="memorable" name="memorable" class="monofont" rows="3" cols="44"></textarea>
      </div>
      <div class="field">
        <span class="label">简单说说你离校后这几年的经历吧</span>
        <textarea id="description" name="description" class="monofont" rows="3" cols="44"></textarea>
      </div>
    </fieldset>
    <fieldset>
      <legend>感恩·梦想</legend>
      <blockquote>
        <p class="prolog">
          无忘饮水思源意，有待乘风破浪时
        </p>
      </blockquote>
      <div class="field">
        <span class="label">你是否能到现场参加庆典活动：</span>
        <input type="checkbox" id="presentable" name="presentable"/>
      </div>
      <div class="field">
        <span class="label">你对庆典活动安排有何希望和建议</span>
        <textarea id="advices" name="advices" class="monofont" rows="3" cols="44"></textarea>
      </div>
      <div class="field">
        <span class="label">活动以感恩为一大主题，希望毕业学子能尽其所能回报母校，你是否愿意捐赠？或有何想法？</span>
        <textarea id="contributes" name="contributes" class="monofont" rows="3" cols="44"></textarea>
      </div>
    </fieldset>
    <div class="failure" style="display:none"></div>
    <div class="action">
      <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
        <span>提交我的个人信息</span>
      </button>
    </div>
    <p class="clear"></p>
  </form>
</section>
<aside>
  <h2>填写说明</h2>
  <ul>
    <li>学号如果记不住可以不填</li>
    <li>提交之后，除基本信息外都不能更改</li>
  </ul>
</aside>
<?php
$javascripts = array('datepicker/WdatePicker', 'jquery-1.7.1.min', 'profile/new');
include(__DIR__ . '/../layout/footer.php');
