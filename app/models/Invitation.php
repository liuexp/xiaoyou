<?php
class Invitation extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public static function isValid($email, $invitecode, $realname)
  {
    // TODO
    return false;
  }
  
  public static function markRegistered($email, $invitecode)
  {
    // TODO
  }
}
