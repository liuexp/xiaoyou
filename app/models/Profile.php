<?php
class Profile extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public function isMale()
  {
    return $this->getGender() == 'M';
  }
  
  public function getExperiences()
  {
    return fRecordSet::build('Experience', array('profile_id=' => $this->getId()));
  }
  
  public function getPapers()
  {
    return fRecordSet::build('Paper', array('profile_id=' => $this->getId()));
  }
  
  public function getHonors()
  {
    return fRecordSet::build('Honor', array('profile_id=' => $this->getId()));
  }
}
