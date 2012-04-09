<?php
class Tweet extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public function getProfile()
  {
    return new Profile($this->getProfileId());
  }
  
  public function getComments()
  {
    return fRecordSet::build('TweetComment', array('tweet_id=' => $this->getId()), array('timestamp' => 'asc'));
  }
}
