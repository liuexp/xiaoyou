<?php
$app = new Slim();

// The following routes are accessed directly via browser

$app->get('/', function () {
  // TODO front page
  echo 'home';
});

$app->get('/articles', function () {
  // TODO list articles
  echo 'articles';
});

$app->post('/articles', function () {
  // TODO create article
});

$app->get('/article/:id', function ($id) {
  // TODO show article (including edit)
  echo 'article '.$id;
});

$app->delete('/article/:id', function ($id) {
  // TODO delete article
});

$app->get('/profiles', function () {
  // TODO list profiles
  echo 'profiles';
});

$app->post('/profiles', function () {
  // TODO create profile
});

$app->get('/profile/:id', function ($id) {
  // TODO show profile (including edit)
  echo 'profile '.$id;
});

// The following routes are accessed via AJAX

$app->put('/article/:id', function ($id) {
  // TODO update/save article
});

$app->put('/profile/:id', function ($id) {
  // TODO update/save profile
});

$app->post('/contacts', function () {
  // TODO create contact
});

$app->put('/contact/:id', function ($id) {
  // TODO update/save contact
});

$app->delete('/contact/:id', function ($id) {
  // TODO delete contact
});

$app->post('/experiences', function () {
  // TODO create experience
});

$app->put('/experience/:id', function ($id) {
  // TODO update/save experience
});

$app->delete('/experience/:id', function ($id) {
  // TODO delete experience
});

$app->post('/honors', function () {
  // TODO create honor
});

$app->put('/honor/:id', function ($id) {
  // TODO update/save honor
});

$app->delete('/honor/:id', function ($id) {
  // TODO delete honor
});

$app->post('/papers', function () {
  // TODO create paper
});

$app->put('/paper/:id', function ($id) {
  // TODO update/save paper
});

$app->delete('/paper/:id', function ($id) {
  // TODO delete paper
});

// TODO add routes for invitations
// TODO add routes for uploading avatars

$app->run();
