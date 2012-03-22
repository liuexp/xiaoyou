<?php
class HomeController extends ApplicationController
{
  public function index()
  {
    $this->articles = fRecordSet::build(
      'Article', array('type=' => 'news', 'visible=' => 1), array('priority' => 'desc', 'created_at' => 'desc'));
    $this->posts = fRecordSet::build(
      'Article', array('type=' => 'post', 'visible=' => 1), array('priority' => 'desc', 'created_at' => 'desc'));
    $this->render('home/index');
  }
}
