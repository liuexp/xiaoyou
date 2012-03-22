<?php
class Profile extends fActiveRecord
{
  protected function configure()
  {
    fORMValidation::addStringReplacement($this, 'Login Name: The value specified must be unique, however it already exists', '不能重复创建个人信息');
    fORMValidation::addStringReplacement($this, 'Start Year: Please enter a value', '请选择入学年份');
    fORMValidation::addStringReplacement($this, 'Birthday: Please enter a value', '请选择生日');
    fORMValidation::addStringReplacement($this, 'Gender: Please enter a value', '请选择性别');
    fORMValidation::addStringReplacement($this, 'Location: Please enter a value', '请填写现居住地');
    fORMValidation::addStringReplacement($this, 'Hometown: Please enter a value', '请填写家乡');
    fORMValidation::addStringReplacement($this, 'High School: Please enter a value', '请填写高中名称');
  }
  
  public function isMale()
  {
    return $this->getGender() == 'M';
  }
  
  public function getContacts()
  {
    return fRecordSet::build('Contact', array('profile_id=' => $this->getId()));
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
