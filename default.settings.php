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

define('SESSIONS_PATH', '/Users/xjia/tmp/sessions/');

define('ACM_CLASS_FLV', '/avatars/acm-class.flv');

/**
 * Send invitations with Reply-To this email.
 */
define('ADMIN_EMAIL', 'admin@example.com');

define('GLOBAL_INVITATION_EMAIL', 'xiaoyou@acm.sjtu.edu.cn');
define('GLOBAL_INVITATION_CODE', 'DO REMEMBER TO CHANGE THIS');

/**
 * Number of recent activities displayed on the front-page.
 */
define('ACTIVITIES_LIMIT', 10);

/**
 * When does the celebration start?
 */
define('COUNTDOWN_GOAL', '2012-06-09 8:00 am');

/**
 * List the user names of editors here.
 * Separate names using the pipe sign (|).
 */
define('EDITOR_IDS', '|root|xjia|');

/**
 * Put the ID of the article of schedule here.
 * If no schedule is published, put -1.
 */
define('SCHEDULE_ARTICLE_ID', 2);

define('CORRESPONDS_ARTICLE_ID', 5);//联系人

define('CREDITS_ARTICLE_ID', 7);

define('RECENT_ARTICLE_THRESHOLD', 5);

define('TEACHERS_ARTICLE_ID', 10056);
