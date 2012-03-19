<?php
class ArticleController extends ApplicationController
{
  public function index()
  {
    // send all articles along with their contents
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
