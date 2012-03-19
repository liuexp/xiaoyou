<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>登录 | <?php echo SITE_TITLE; ?></title>
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
					<form action="<?php echo LOGIN_BASE; ?>/" id="login-form" method="POST" autocomplete="off">
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
</body>
</html>
