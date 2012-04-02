<?php
class HomeController extends ApplicationController
{
  public function index()
  {
    $this->countdown_goal = new fTimestamp(COUNTDOWN_GOAL);
    $this->countdown_now = new fTimestamp();
    $this->reach_countdown = $this->countdown_now->gte($this->countdown_goal);
    if (!$this->reach_countdown) {
      $goal = strtotime($this->countdown_goal->format('Y-m-d H:i:s'));
      $diff = $goal - time();
      $this->seconds = $diff % 60; $diff = ($diff - $this->seconds) / 60;
      $this->minutes = $diff % 60; $diff = ($diff - $this->minutes) / 60;
      $this->hours   = $diff % 24; $diff = ($diff - $this->hours)   / 24;
      $this->days    = $diff;
    }
    $this->articles = fRecordSet::build(
      'Article', array('type=' => 'news', 'visible=' => 1), array('priority' => 'desc', 'created_at' => 'desc'), ACTIVITIES_LIMIT);
    $this->posts = fRecordSet::build(
      'Article', array('type=' => 'post', 'visible=' => 1), array('priority' => 'desc', 'created_at' => 'desc'), ACTIVITIES_LIMIT - 1);
    $this->activities = fRecordSet::build('Activity', array(), array('timestamp' => 'desc'), ACTIVITIES_LIMIT);
    $this->render('home/index');
  }
}
