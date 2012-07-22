<?php
class SearchController extends ApplicationController
{
  public function index()
  {  
    $this->editable = UserHelper::isEditor();
    if ($this->editable) {
      $this->articles = fRecordSet::build(
        'Article', array('type=' => 'news'), array('priority' => 'desc', 'created_at' => 'asc'));
    } else {
      $this->articles = fRecordSet::build(
        'Article', array('type=' => 'news', 'visible=' => 1), array('priority' => 'desc', 'created_at' => 'asc'));
    }
    $this->render('article/index');
  }
  
  public function showResult()
  {
    $this->editable = UserHelper::isEditor();
    if ($this->editable) {
      $this->articles = fRecordSet::build(
        'Article', array('type=' => 'post'), array('created_at' => 'asc'));
    } else {
      $this->articles = fRecordSet::build(
        'Article', array('type=' => 'post', 'visible=' => 1), array('created_at' => 'asc'));
    }
    $this->render('article/posts');
  }
 }
