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
    <div class="failure" style="display:none"></div>
    <div class="action">
      <button id="create-account" type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
        <span>创建我的帐户</span>
      </button>
      <p class="clear"></p>
    </div>
  </form>
</section>
<aside>
  <h2>填写说明</h2>
  <ul>
    <li>注册表单中所有项目都必填</li>
    <li>真实姓名请用中文</li>
    <li>注册之后，还需要创建个人信息、完善个人资料，大约占用15分钟时间</li>
  </ul>
</aside>
<?php
$javascripts = array('jquery-1.7.1.min', 'register/show');
include(__DIR__ . '/../layout/footer.php');
