<?php
class LoginController extends ApplicationController
{
  public function passwd()
  {
    $this->render('home/passwd');
  }
  public function login()
  {
    $this->render('home/login');
  }
}
