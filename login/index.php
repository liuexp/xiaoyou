<?php
include_once(__DIR__ . '/inc/init.php');

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

  include(__DIR__ . '/tpl/login.php');
}
