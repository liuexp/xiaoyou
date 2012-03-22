<?php
$app = new Slim();

// The following routes are accessed directly via browser

$app->get('/', function () {
  $controller = new HomeController();
  $controller->index();
});

$app->get('/register', function () {
  $controller = new RegisterController();
  $controller->show();
});

$app->get('/invite', function () {
  fAuthorization::requireLoggedIn();
  $controller = new InviteController();
  $controller->show();
});

// article list page contains popup window
// for creating new articles
$app->get('/articles', function () {
  $controller = new ArticleController();
  $controller->index();
});

$app->get('/article/:id/edit', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ArticleController();
  $controller->edit($id);
});

$app->get('/schedule', function () {
  $controller = new ArticleController();
  $controller->showSchedule();
});

$app->get('/corresponds', function () {
  $controller = new ArticleController();
  $controller->showCorresponds();
});

$app->get('/posts', function () {
  $controller = new ArticleController();
  $controller->showPosts();
});

$app->get('/profiles', function () {
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

$app->put('/profile/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ProfileController();
  $controller->update($id);
});

$app->post('/contacts', function () {
  fAuthorization::requireLoggedIn();
  $controller = new ContactController();
  $controller->create();
});

$app->put('/contact/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ContactController();
  $controller->update($id);
});

$app->delete('/contact/:id', function ($id) {
  fAuthorization::requireLoggedIn();
  $controller = new ContactController();
  $controller->delete($id);
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

// TODO add routes for uploading avatars

$app->run();
