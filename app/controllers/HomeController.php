<?php
class HomeController extends ApplicationController
{
  public function index()
  {
    $this->articles = fRecordSet::build('Article');
    $this->render('home/index');
  }
}
