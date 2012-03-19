<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link href="<?php echo SITE_BASE; ?>/images/favicon.png" rel="shortcut icon"/>
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
            <a href="<?php echo SITE_BASE; ?>/invite">邀请同学</a> |
            <a href="<?php echo SITE_BASE; ?>/login/change-password.php">修改密码</a> |
            <a href="<?php echo SITE_BASE; ?>/login/logout.php?back=<?php echo $_SERVER['REQUEST_URI']; ?>">登出</a>
          <?php else: ?>
            <a href="<?php echo SITE_BASE; ?>/register">注册</a> |
            <a href="<?php echo SITE_BASE; ?>/login/">登录</a>
          <?php endif; ?>
        </span>
        <a href="<?php echo SITE_BASE; ?>/">
          <img alt="上海交通大学ACM班" src="<?php echo SITE_BASE; ?>/images/head-logo.png"/>
        </a>
        <nav>
          <a href="<?php echo SITE_BASE; ?>/">首页</a>
          <a href="<?php echo SITE_BASE; ?>/articles">新闻</a>
          <a href="<?php echo SITE_BASE; ?>/schedule">日程</a>
          <a href="<?php echo SITE_BASE; ?>/profiles">花名册</a>
        </nav>
      </div>
    </header>
    <div class="text columns home <?php echo isset($no_sidebar) ? 'nosidebar' : 'sidebar'; ?>">
