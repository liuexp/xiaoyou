<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>修改密码 | <?php echo SITE_TITLE; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo LOGIN_BASE; ?>/css/base.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="<?php echo LOGIN_BASE; ?>/css/login.css" media="screen"/>
</head>
<body id="login">
	<div id="login-box">
		<div id="content">
			<div id="login-form-wrap">
				<h1 id="logotype"><?php echo SITE_TITLE; ?></h1>
				<div id="flash-block"><?php echo $errmsg; ?></div>
				<div>
					<form action="<?php echo LOGIN_BASE; ?>/change-password.php" id="login-form" method="POST" autocomplete="off">
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
						document.getElementById('password').focus();
					</script>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
