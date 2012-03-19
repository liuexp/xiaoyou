<?php
$title = '注册';
$stylesheets = array('register');
include(__DIR__ . '/../layout/header.php');
?>
<section>
  <h1>注册</h1>
  <form id="register" method="POST">
    <fieldset>
      <legend>邀请信息</legend>
      <div class="field">
        <label for="email">Email地址：</label>
        <input class="textfield monofont" type="email" id="email" name="email" maxlength="200"/>
      </div>
      <div class="field">
        <label for="invitecode">邀请码：</label>
        <input class="textfield monofont" type="text" id="invitecode" name="invitecode" maxlength="20"/>
      </div>
      <div class="field">
        <label for="realname">真实姓名：</label>
        <input class="textfield monofont" type="text" id="realname" name="realname" maxlength="5"/>
      </div>
    </fieldset>
    <fieldset>
      <legend>登录信息</legend>
      <div class="field">
        <label for="username">用户名：</label>
        <input class="textfield monofont" type="text" id="username" name="username" maxlength="80"/>
      </div>
      <div class="field">
        <label for="password">密码：</label>
        <input class="textfield monofont" type="password" id="password" name="password" maxlength="80"/>
      </div>
      <div class="field">
        <label for="confirm">确认密码：</label>
        <input class="textfield monofont" type="password" id="confirm" name="confirm" maxlength="80"/>
      </div>
    </fieldset>
    <fieldset>
      <legend>完成注册</legend>
      <div class="field sure">
        <input type="checkbox" id="sure" name="sure"/>
        <label for="sure">我确认上述信息完全正确</label>
      </div>
      <div class="action">
        <input class="submit" type="submit" name="submit" value="创建我的帐户"/> <!-- TODO use a GitHub style green button -->
      </div>
    </fieldset>
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
include(__DIR__ . '/../layout/footer.php');
