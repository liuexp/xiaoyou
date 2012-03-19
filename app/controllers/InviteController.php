<?php
class InviteController extends ApplicationController
{
  public function show()
  {
    $this->render('invite/show');
  }
  
  public function submit()
  {
    echo "hi";
  }
}
