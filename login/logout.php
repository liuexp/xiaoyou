<?php
include_once(__DIR__ . '/inc/init.php');

$back_url = fRequest::get('back');
fAuthorization::destroyUserInfo();
fSession::clear();
if (empty($back_url)) {
  fURL::redirect(SITE_BASE);
} else {
  fURL::redirect($back_url);
}
