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
    return Name::exist($realname) and (self::isGlobalInvitation($email, $invitecode) or self::existAvailable($email, $invitecode));
  }
  
  public static function isGlobalInvitation($email, $invitecode)
  {
    return ($email == GLOBAL_INVITATION_EMAIL) and ($invitecode == GLOBAL_INVITATION_CODE);
  }
  
  public static function markRegistered($email, $invitecode)
  {
    try {
      if (self::isGlobalInvitation($email, $invitecode)) return;
      $invitation = fRecordSet::build('Invitation', array('email=' => $email, 'invitecode=' => $invitecode))->getRecord(0);
      $invitation->setUserRegistered(1);
      $invitation->store();
    } catch (Exception $e) {
      // do nothing
    }
  }
}
