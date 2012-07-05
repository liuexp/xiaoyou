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

  public function getReplies(){
    return fRecordSet::build('Mail', array('parent=' => $this->getId()), array('timestamp' => 'asc'));
  }

  public function getReplyTimestamp()
  {
    $comments = $this->getReplies()->getRecords();
    if ($n = count($comments)) {
      return $comments[$n - 1]->getTimestamp();
    }
    return $this->getTimestamp();
  }

}
