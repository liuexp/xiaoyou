<?php
$app = new Slim();

// The following routes are accessed directly via browser

$app->get('/', function () {
  UserHelper::requireProfile();
  $controller = new HomeController();
  $controller->index();
});

$app->get('/chat', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ChatController();
  $controller->index();
});

$app->post('/chat', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ChatController();
  $controller->sendMessage();
});

$app->get('/chat/sendform', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ChatController();
  $controller->showSendForm();
});

$app->get('/chat/messages', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ChatController();
  $controller->listMessages();
});

$app->get('/chat/ajax-messages', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ChatController();
  $controller->ajaxMessages();
});

$app->get('/chat/users', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ChatController();
  $controller->listUsers();
});

$app->get('/chat/ajax-users', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ChatController();
  $controller->ajaxUsers();
});

$app->get('/inbox', function () {
  UserHelper::requireProfile();
  $controller = new MailController();
  $controller->inbox();
});

$app->get('/outbox', function () {
  UserHelper::requireProfile();
  $controller = new MailController();
  $controller->sent();
});


$app->post('/inbox', function () {
  fAuthorization::requireLoggedIn();
  $controller = new MailController();
  $controller->create();
});

$app->delete('/inbox/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new MailController();
  $controller->delete($id);
});


$app->get('/tweets', function () {
  UserHelper::requireProfile();
  $controller = new TweetController();
  $controller->index();
});

$app->post('/tweets', function () {
  fAuthorization::requireLoggedIn();
  $controller = new TweetController();
  $controller->create();
});

$app->delete('/tweet/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new TweetController();
  $controller->delete($id);
});

$app->post('/tweet/:id/reply', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new TweetController();
  $controller->reply($id);
});

$app->post('/article/:id/reply', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ArticleController();
  $controller->reply($id);
});

$app->get('/invite/send', function () {
  fAuthorization::requireLoggedIn();
  $controller = new InviteController();
  $controller->sendEmails();
});

$app->get('/notice/send', function () {
  fAuthorization::requireLoggedIn();
  $controller = new InviteController();
  $controller->prepareNoticeEmails();
});

$app->post('/notice/send', function () {
  fAuthorization::requireLoggedIn();
  $controller = new InviteController();
  $controller->sendNoticeEmails();
});
/*
$app->get('/intro', function () {
  UserHelper::requireProfile();
  $controller = new VideoController();
  $controller->show();
});
 */

$app->get('/register', function () {
  $controller = new RegisterController();
  $controller->show();
});

$app->get('/invite', function () {
  fAuthorization::requireLoggedIn();
  UserHelper::requireProfile();
  $controller = new InviteController();
  $controller->show();
});

$app->post('/avatar/upload', function () {
  fAuthorization::requireLoggedIn();
  $controller = new AvatarController();
  $controller->upload();
});

$app->get('/avatar/edit', function () {
  fAuthorization::requireLoggedIn();
  $controller = new AvatarController();
  $controller->edit();
});

$app->get('/manage_known_users', function () {
  fAuthorization::requireLoggedIn();
  $controller = new NameController();
  $controller->showKnown();
});
$app->get('/manage_users/:id/edit', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new NameController();
  $controller->edit($id);
});


// article list page contains popup window
// for creating new articles
$app->get('/articles', function () {
  UserHelper::requireProfile();
  $controller = new ArticleController();
  $controller->index();
});

$app->get('/article/:id', function ($id) {
  UserHelper::requireProfile();
  $controller = new ArticleController();
  $controller->show($id);
});

$app->get('/article/:id/edit', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ArticleController();
  $controller->edit($id);
});

$app->get('/posts', function () {
  UserHelper::requireProfile();
  $controller = new ArticleController();
  $controller->showPosts();
});

$app->get('/credits', function () {
  UserHelper::requireProfile();
  $controller = new ArticleController();
  $controller->showCredits();
});

$app->get('/profiles', function () {
  UserHelper::requireProfile();
  $controller = new ProfileController();
  $controller->index();
});

$app->get('/profiles/check', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ProfileController();
  $controller->check();
});

$app->get('/profiles/new', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ProfileController();
  $controller->newProfile();
});

$app->get('/profile/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  UserHelper::requireProfile();
  $controller = new ProfileController();
  $controller->show($id);
});

$app->get('/experience/:id/edit', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ExperienceController();
  $controller->edit($id);
});

$app->get('/paper/:id/edit', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new PaperController();
  $controller->edit($id);
});

$app->get('/honor/:id/edit', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new HonorController();
  $controller->edit($id);
});

// The following routes are accessed via AJAX

$app->post('/avatar/update', function () {
  fAuthorization::requireLoggedIn();
  $controller = new AvatarController();
  $controller->update();
});

$app->post('/register', function () {
  $controller = new RegisterController();
  $controller->submit();
});

$app->post('/invite', function () {
  fAuthorization::requireLoggedIn();
  $controller = new InviteController();
  $controller->submit();
});

$app->post('/articles', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ArticleController();
  $controller->create();
});

$app->post('/manage_users', function () {
  fAuthorization::requireLoggedIn();
  $controller = new NameController();
  $controller->create();
});


// fuck slim reads php://input before flourish
$app->post('/manage_users/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new NameController();
  $controller->update($id);
});

$app->delete('/manage_users/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new NameController();
  $controller->delete($id);
});


$app->post('/article/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ArticleController();
  $controller->update($id);
});

$app->delete('/article/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ArticleController();
  $controller->delete($id);
});

$app->post('/profiles', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ProfileController();
  $controller->create();
});

$app->post('/profile/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ProfileController();
  $controller->update($id);
});

$app->post('/experiences', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ExperienceController();
  $controller->create();
});

// fuck slim reads php://input before flourish
$app->post('/experience/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ExperienceController();
  $controller->update($id);
});

$app->delete('/experience/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ExperienceController();
  $controller->delete($id);
});

$app->post('/honors', function () {
  fAuthorization::requireLoggedIn();
  $controller = new HonorController();
  $controller->create();
});

// fuck slim reads php://input before flourish
$app->post('/honor/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new HonorController();
  $controller->update($id);
});

$app->delete('/honor/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new HonorController();
  $controller->delete($id);
});

$app->post('/papers', function () {
  fAuthorization::requireLoggedIn();
  $controller = new PaperController();
  $controller->create();
});

// fuck slim reads php://input before flourish
$app->post('/paper/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new PaperController();
  $controller->update($id);
});

$app->delete('/paper/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new PaperController();
  $controller->delete($id);
});

$app->run();
