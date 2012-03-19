<?php
require_once('vendor/flourish.php');
require_once('vendor/slim.php');
require_once('vendor/markdown.php');

require_once('models/Article.php');
require_once('models/Contact.php');
require_once('models/Experience.php');
require_once('models/Honor.php');
require_once('models/Paper.php');
require_once('models/Profile.php');
require_once('models/Invitation.php');

require_once('controllers/ApplicationController.php');
require_once('controllers/ArticleController.php');
require_once('controllers/ContactController.php');
require_once('controllers/ExperienceController.php');
require_once('controllers/HomeController.php');
require_once('controllers/HonorController.php');
require_once('controllers/PaperController.php');
require_once('controllers/ProfileController.php');

require_once('routes.php');
