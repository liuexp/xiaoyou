<?php
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('Asia/Shanghai');

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

/**
 * Interval of sending invitations.
 *   15m means 15 minutes
 *   1h means 1 hour
 */
define('INVITE_INTERVAL', '15m');
