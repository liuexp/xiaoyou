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
}
