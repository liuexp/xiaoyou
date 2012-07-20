<?php
class HomeController extends ApplicationController
{
  public function index()
  {
    $this->articles = fRecordSet::build(
      'Article',
      array('type=' => 'news', 'visible=' => 1),
      array('priority' => 'desc', 'created_at' => 'desc'),
      ACTIVITIES_LIMIT - 2
    );
    $this->posts = fRecordSet::build(
      'Article',
      array('type=' => 'post', 'visible=' => 1, 'priority<' => 999999),
      array('priority' => 'desc', 'created_at' => 'desc'),
      ACTIVITIES_LIMIT - 1
    );
    $this->activities = fRecordSet::buildFromSQL(
      'Activity',
      'SELECT activities.* FROM activities GROUP BY realname,type,DATE(timestamp),HOUR(timestamp) ORDER BY timestamp DESC LIMIT ' . ACTIVITIES_LIMIT
    );
    $this->render('home/index');
  }
}
