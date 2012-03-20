<?php
class Invitation extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public static function isValid($email, $invitecode, $realname)
  {
    // TODO
    return true;
  }
  
  public static function markRegistered($email, $invitecode)
  {
    // TODO
  }
}
