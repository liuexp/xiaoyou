<?php
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('Asia/Shanghai');
set_time_limit(600);  // 10 minutes

// Xiaoyou database
define('DB_NAME', 'xiaoyou');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');

// User information database (for registration)
define('UDB_NAME', 'users');
define('UDB_USER', 'usermanager');
define('UDB_PASS', '');
define('UDB_HOST', 'localhost');

// Misc.
define('HOST_URL', 'http://localhost');
define('SITE_BASE', '/xiaoyou');
define('TITLE_SUFFIX', ' | ACM班校友录');
define('AVATAR_DIR', '/Users/xjia/tmp/avatar/');
define('AVATAR_BASE', '/avatars');
define('UPLOAD_DIR', '/srv/http/xiaoyou/upload/');
define('UPLOAD_BASE', '/upload');
define('UPLOAD_EXT',array('jpg','png','bmp','gif'));
define('SMTP_ADDR', 'smtp.gmail.com');
define('SMTP_PORT', '465');
define('SMTP_USER', 'liuexp@gmail.com');
define('SMTP_PASS', '');


define('SESSIONS_PATH', '/Users/xjia/tmp/sessions/');

/**
 * Send invitations with Reply-To this email.
 */
define('ADMIN_EMAIL', 'admin@example.com');
/**
 * Number of recent activities displayed on the front-page.
 */
define('ACTIVITIES_LIMIT', 10);

/**
 * List the user names of editors here.
 * Separate names using the pipe sign (|).
 */
define('EDITOR_IDS', '|root|xjia|');
define('RECENT_ARTICLE_THRESHOLD', 5);

