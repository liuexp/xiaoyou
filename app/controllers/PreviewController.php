<?php
class PreviewController extends ApplicationController
{
 
  public function show()
  {
    $this->data = Markdown(fRequest::get('data'));
    $this->render('raw');
    
  }
 
}
