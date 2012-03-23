<?php
$app = new Slim();

// The following routes are accessed directly via browser

$app->get('/', function () {
  UserHelper::requireProfile();
  $controller = new HomeController();
  $controller->index();
});

$app->get('/intro', function () {
  fAuthorization::requireLoggedIn();
  UserHelper::requireProfile();
  $controller = new VideoController();
  $controller->show();
});

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

$app->get('/schedule', function () {
  UserHelper::requireProfile();
  $controller = new ArticleController();
  $controller->showSchedule();
});

$app->get('/corresponds', function () {
  UserHelper::requireProfile();
  $controller = new ArticleController();
  $controller->showCorresponds();
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

// fuck slim reads php://input before flourish
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
