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
    </fieldset>
    <fieldset>
      <legend>自我描述</legend>
      <div class="field">
        <textarea name="description" class="monofont" rows="3" cols="45"></textarea>
      </div>
    </fieldset>
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
    <li>鹅鹅鹅</li>
    <li>鹅鹅鹅</li>
    <li>鹅鹅鹅</li>
    <li>鹅鹅鹅</li>
  </ul>
</aside>
<?php
$javascripts = array('datepicker/WdatePicker');
include(__DIR__ . '/../layout/footer.php');
