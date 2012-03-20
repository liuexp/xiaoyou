<?php
class ArticleController extends ApplicationController
{
  public function index()
  {
    $this->articles = fRecordSet::build('Article');
    $this->editable = true; // TODO
    $this->render('article/index');
  }
  
  public function showSchedule()
  {
  }
  
  public function create()
  {
  }
  
  public function update($id)
  {
  }
  
  public function delete($id)
  {
  }
}
