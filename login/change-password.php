<?php
include_once(__DIR__ . '/inc/init.php');

fAuthorization::requireLoggedIn();

$errmsg = '';

if (fRequest::isPost()) {
  $old_password = fRequest::get('old-password');
  $new_password = fRequest::get('new-password');
  $confirm_password = fRequest::get('confirm-password');
  if (empty($old_password) or empty($new_password) or empty($confirm_password)) {
    $errmsg = '密码不能为空';
  } else if ($new_password != $confirm_password) {
    $errmsg = '两次输入的新密码不一致';
  } else if (login_check_credential($db, fSession::get('current_user[name]'), $old_password) == false) {
    $errmsg = '旧密码错误';
  } else if (login_change_password($db, fAuthorization::getUserToken(), $new_password)) {
    fURL::redirect(fSession::delete('change-password-referer', SITE_BASE));
  } else {
    $errmsg = '修改密码失败';
  }
} else {
  if (fSession::get('change-password-referer') == null) {
    fSession::set('change-password-referer', login_get_referer(SITE_BASE));
  }
}

include(__DIR__ . '/tpl/change-password.php');
