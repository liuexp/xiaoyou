<?php
class Mail extends fActiveRecord
{
  protected function configure()
  {
  }
   
  public function getRecvProfile()
  {
    return new Profile($this->getReceiver());
  }
 
  public function getSendProfile()
  {
    return new Profile($this->getSender());
  }
}
