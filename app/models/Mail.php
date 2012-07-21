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

  public function hasUnRead($id=0){
	$mails= fRecordSet::build('Mail', array('receiver=' => $id, 'parent=' => $this->getId(),'read=' =>0), array('timestamp' => 'asc'));

	foreach($mails as $m){
		$m->setRead(1);
		$m->store();
	}
	if($this->getReceiver()==$id){
		$this->setRead(1);
		$this->store();
	}

 	if($this->getRead()){
		return $mails->count()>0;
	}else return true;
   }
}
