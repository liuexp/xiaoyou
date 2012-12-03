<?php
if (fAuthorization::checkLoggedIn()) {
  fURL::redirect(fAuthorization::getRequestedURL(false, SITE_BASE));
} else {
  $errmsg = '';
  $username = '';

  if (fRequest::isPost()) {
    $username = fRequest::get('username');
    $password = fRequest::get('password');
    if (empty($username)) {
      $errmsg = '请输入用户名';
    } else if (empty($password)) {
      $errmsg = '请输入密码';
    } else if (!login_authenticate($db, $username, $password)) {
      $errmsg = '登录失败';
    } else {
      fURL::redirect(fAuthorization::getRequestedURL(false, SITE_BASE));
    }
  }
$title = '登陆';
$no_sidebar = true;
$no_columns = true;
$stylesheets = array('login');
include(__DIR__ . '/../layout/header.php');

?>

<div id="login">
<div id="login-mainer">
			<div id="login-pic"></div>
			<div id="login-form-wrap">
			<h1 id="logotype" style="font-weight:bold"><?php echo $title; ?></h1>
				<div id="flash-block"><?php echo $errmsg; ?></div>
				<div>
				<form action="<?php echo SITE_BASE; ?>/login/" id="login-form" method="POST">
						<fieldset>
							<legend>登录</legend>
							<label for="username">
								<span class="hint fn-right">请输入您的用户名</span>
								用户名
							</label>
							<input type="text" name="username" value="<?php echo $username; ?>" tabindex="1" id="username"/>
							<label for="password">
								<span class="hint fn-right">请输入您的密码</span>
								密码
							</label>
							<input type="password" name="password" tabindex="2" id="password"/>
							<input type="submit" value="登录" class="button fn-left" tabindex="3" id="submit"/>
						</fieldset>
					</form>
					<script type="text/javascript">
						document.getElementById('username').focus();
					</script>
				</div>
			</div>
		</div>
</div>
<?php
$javascripts = array('jquery-1.4.2.min', 'jquery.countdown', 'home/index');
include(__DIR__ . '/../layout/footer.php');
}
