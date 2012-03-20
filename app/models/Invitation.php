<?php
class Invitation extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public static function existAvailable($email, $invitecode)
  {
    return fRecordSet::build('Invitation', array(
      'email=' => $email,
      'invitecode=' => $invitecode,
      'user_registered=' => 0
    ))->count() > 0;
  }
  
  public static function isValid($email, $invitecode, $realname)
  {
    return self::existAvailable($email, $invitecode) and Name::exist($realname);
  }
  
  public static function markRegistered($email, $invitecode)
  {
    $invitation = fRecordSet::build('Invitation', array('email=' => $email, 'invitecode=' => $invitecode))->getRecord(0);
    $invitation->setUserRegistered(1);
    $invitation->store();
  }
}
