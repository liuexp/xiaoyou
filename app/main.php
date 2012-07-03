<?php
define('CACHE_PROFILES', '/tmp/xiaoyou-profiles.cache');

require_once(__DIR__ . '/vendor/flourish.php');
require_once(__DIR__ . '/vendor/slim.php');
require_once(__DIR__ . '/vendor/markdown.php');
require_once(__DIR__ . '/vendor/lib_acm_userpass.php');

require_once(__DIR__ . '/init.php');

require_once(__DIR__ . '/models/Activity.php');
require_once(__DIR__ . '/models/Article.php');
require_once(__DIR__ . '/models/ArticleComment.php');
require_once(__DIR__ . '/models/Contact.php');
require_once(__DIR__ . '/models/Experience.php');
require_once(__DIR__ . '/models/Honor.php');
require_once(__DIR__ . '/models/Invitation.php');
require_once(__DIR__ . '/models/Mail.php');
require_once(__DIR__ . '/models/Name.php');
require_once(__DIR__ . '/models/Paper.php');
require_once(__DIR__ . '/models/Profile.php');
require_once(__DIR__ . '/models/Tweet.php');
require_once(__DIR__ . '/models/TweetComment.php');

require_once(__DIR__ . '/controllers/ApplicationController.php');
require_once(__DIR__ . '/controllers/ArticleController.php');
require_once(__DIR__ . '/controllers/AvatarController.php');
require_once(__DIR__ . '/controllers/ExperienceController.php');
require_once(__DIR__ . '/controllers/HomeController.php');
require_once(__DIR__ . '/controllers/HonorController.php');
require_once(__DIR__ . '/controllers/HelpController.php');
require_once(__DIR__ . '/controllers/InviteController.php');
require_once(__DIR__ . '/controllers/MailController.php');
require_once(__DIR__ . '/controllers/NameController.php');
require_once(__DIR__ . '/controllers/PaperController.php');
require_once(__DIR__ . '/controllers/ProfileController.php');
require_once(__DIR__ . '/controllers/RegisterController.php');
require_once(__DIR__ . '/controllers/VideoController.php');
require_once(__DIR__ . '/controllers/TweetController.php');
require_once(__DIR__ . '/controllers/ChatController.php');

require_once(__DIR__ . '/helpers/Util.php');
require_once(__DIR__ . '/helpers/UserHelper.php');
require_once(__DIR__ . '/helpers/NameHelper.php');
require_once(__DIR__ . '/helpers/ActivityHelper.php');
require_once(__DIR__ . '/helpers/TweetHelper.php');

require_once(__DIR__ . '/routes.php');
