<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <!--[if lt IE 7]>
    <script type="text/javascript">var IE7_PNG_SUFFIX = ".png";</script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/IE9.js"></script>
    <![endif]-->
    <link href="<?php echo SITE_BASE; ?>/images/icon.ico" rel="shortcut icon"/>
    <meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" name="viewport"/>
    <title>
      <?php echo $title . TITLE_SUFFIX; ?>
    </title>
    <link href="<?php echo SITE_BASE; ?>/css/redis.css" rel="stylesheet" type="text/css"/>
    <?php if (isset($stylesheets)) foreach ($stylesheets as $stylesheet): ?>
      <link href="<?php echo SITE_BASE; ?>/css/<?php echo $stylesheet; ?>.css" rel="stylesheet" type="text/css"/>
    <?php endforeach; ?>
  </head>
  <body>
    <header>
      <div class="container">
        <span class="userinfo">
          <?php if (fAuthorization::checkLoggedIn()): ?>
            <?php
              if (UserHelper::hasProfile()) {
                $profile_link = SITE_BASE . '/profile/' . UserHelper::getProfileId();
              } else {
                $profile_link = SITE_BASE . '/profiles/new';
              }
            ?>
            Hi, <a href="<?php echo $profile_link; ?>"><?php echo UserHelper::getDisplayName(); ?></a> |
            <!-- <a href="<?php echo SITE_BASE; ?>/invite">邀请同学</a> | -->
	<?php if (UserHelper::isEditor()): ?>
            <a href="<?php echo SITE_BASE; ?>/manage_known_users">已知校友管理</a> |
          <?php endif; ?>


            <a href="<?php echo SITE_BASE; ?>/inbox">收件箱</a> |
            <a href="<?php echo SITE_BASE; ?>/outbox">发件箱</a> |
            <a href="<?php echo SITE_BASE; ?>/login/change-password.php">修改密码</a> |
            <a href="<?php echo SITE_BASE; ?>/login/logout.php?back=<?php echo SITE_BASE; ?>">登出</a>
          <?php else: ?>
            <a href="<?php echo SITE_BASE; ?>/register">注册</a> |
            <a href="<?php echo SITE_BASE; ?>/login/">登录</a>
          <?php endif; ?>
        </span>
        <a href="<?php echo SITE_BASE; ?>/">
          <img src="<?php echo SITE_BASE; ?>/images/KoGuan_logo.png"/>
        </a>
        <nav>
          <a href="<?php echo SITE_BASE; ?>/">首页</a>
          <a href="<?php echo SITE_BASE; ?>/articles">新闻</a>
          <a href="<?php echo SITE_BASE; ?>/posts">讲座信息</a>
          <!--<a href="<?php echo SITE_BASE; ?>/schedule">日程</a>-->
          <!--<a href="<?php echo SITE_BASE; ?>/teachers">教师</a>-->
          <!-- <a href="<?php echo SITE_BASE; ?>/profiles">花名册</a> -->
          <!--<a href="<?php echo SITE_BASE; ?>/corresponds">筹备组</a>-->
          <a href="<?php echo SITE_BASE; ?>/tweets">微博</a>
          <a href="<?php echo SITE_BASE; ?>/help">帮助</a>
        </nav>
      </div>
    </header>
    <div class="text columns home <?php echo isset($no_sidebar) ? 'nosidebar' : 'sidebar'; ?>">
