<?php
class Name extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public static function exist($realname)
  {
    return fRecordSet::build('Name', array('realname=' => $realname))->count() > 0;
  }
}
