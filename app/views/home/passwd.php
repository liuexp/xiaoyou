<?php
function login_get_referer($default_value)
{
  if (array_key_exists('HTTP_REFERER', $_SERVER)) {
    return $_SERVER['HTTP_REFERER'];
  }
  return $default_value;
}
fAuthorization::requireLoggedIn();

$errmsg = '';

if (fRequest::isPost()) {
  $old_password = fRequest::get('old-password');
  $new_password = fRequest::get('new-password');
  $confirm_password = fRequest::get('confirm-password');
  $token = fAuthorization::getUserToken();
  $username = $token['name'];
  $user_id = $token['id'];
  if (empty($old_password) or empty($new_password) or empty($confirm_password)) {
    $errmsg = '密码不能为空';
  } else if ($new_password != $confirm_password) {
    $errmsg = '两次输入的新密码不一致';
  } else if (login_check_credential($db, $username, $old_password) == false) {
    $errmsg = '旧密码错误';
  } else if (login_change_password($db, $user_id, $new_password)) {
    fURL::redirect(fSession::delete('change-password-referer', SITE_BASE));
  } else {
    $errmsg = '修改密码失败';
  }
} else {
  if (fSession::get('change-password-referer') == null) {
    fSession::set('change-password-referer', login_get_referer(SITE_BASE));
  }
}


$title = '修改密码';
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
				<form action="<?php echo SITE_BASE; ?>/login/change-password.php" id="login-form" method="POST" autocomplete="off">
						<fieldset>
							<legend>修改密码</legend>
							<label for="old-password">
								<span class="hint fn-right">请输入您的旧密码</span>
								旧密码
							</label>
							<input type="password" class="text" name="old-password" tabindex="1" id="old-password"/>
							<label for="new-password">
								<span class="hint fn-right">请输入您的新密码</span>
								新密码
							</label>
							<input type="password" class="text" name="new-password" tabindex="2" id="new-password"/>
							<label for="confirm-password">
								<span class="hint fn-right">请再输入一次您的新密码</span>
								确认新密码
							</label>
							<input type="password" class="text" name="confirm-password" tabindex="3" id="confirm-password"/>
							<input type="submit" value="修改密码" class="button fn-left" tabindex="4" id="submit"/>
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
