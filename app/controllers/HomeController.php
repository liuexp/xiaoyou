<?php
class HomeController extends ApplicationController
{
  public function index()
  {
    $this->reach_countdown = false;
    $this->articles = fRecordSet::build(
      'Article', array('type=' => 'news', 'visible=' => 1), array('priority' => 'desc', 'created_at' => 'desc'));
    $this->posts = fRecordSet::build(
      'Article', array('type=' => 'post', 'visible=' => 1), array('priority' => 'desc', 'created_at' => 'desc'));
    $this->activities = fRecordSet::build('Activity', array(), array('timestamp' => 'desc'), ACTIVITIES_LIMIT);
    $this->render('home/index');
  }
}
