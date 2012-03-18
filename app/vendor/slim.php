<?php
$slim_root = __DIR__ . '/Slim/';

require_once($slim_root . 'Exception/Pass.php');
require_once($slim_root . 'Exception/RequestSlash.php');
require_once($slim_root . 'Exception/Stop.php');

require_once($slim_root . 'Http/Cookie.php');
require_once($slim_root . 'Http/CookieJar.php');
require_once($slim_root . 'Http/Request.php');
require_once($slim_root . 'Http/Response.php');
require_once($slim_root . 'Http/Uri.php');

require_once($slim_root . 'Session/Flash.php');
require_once($slim_root . 'Session/Handler.php');
require_once($slim_root . 'Session/Handler/Cookies.php');

require_once($slim_root . 'Log.php');
require_once($slim_root . 'Logger.php');
require_once($slim_root . 'Route.php');
require_once($slim_root . 'Router.php');
require_once($slim_root . 'View.php');
require_once($slim_root . 'Slim.php');
