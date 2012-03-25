<?php
class UserHelper
{
  public static function getId()
  {
    $token = fAuthorization::getUserToken();
    return $token['id'];
  }
  
  public static function getName()
  {
    $token = fAuthorization::getUserToken();
    return $token['name'];
  }
  
  public static function getEmail()
  {
    $token = fAuthorization::getUserToken();
    return $token['email'];
  }
  
  public static function getDisplayName()
  {
    $token = fAuthorization::getUserToken();
    return $token['display_name'];
  }
  
  public static function isRegistered($profiles, $student)
  {
    foreach ($profiles as $profile)
      if ($profile->getDisplayName() == $student->getRealname())
        return strlen($profile->getStudentNumber()) == 10 ? ($profile->getStudentNumber() == $student->getStudentNumber() || $student->getStudentNumber() == "0000000000") : true;
    return false;
  }
  
  public static function getStudentProfileId($profiles, $student)
  {
    foreach ($profiles as $profile)
      if ($profile->getDisplayName() == $student->getRealname()) {
        if (strlen($profile->getStudentNumber()) == 10) {
          if ($profile->getStudentNumber() == $student->getStudentNumber() || $student->getStudentNumber() == "0000000000") {
            return $profile->getId();
          }
        } else {
          return $profile->getId();
        }
      }
    return 0;
  }
  
  public static function hasProfile($name = null)
  {
    if ($name == null) $name = self::getName();
    try {
      new Profile(array('login_name' => $name));
      return true;
    } catch (fNotFoundException $e) {
      return false;
    }
  }
  
  public static function getProfileId($name = null)
  {
    if ($name == null) $name = self::getName();
    $profile = new Profile(array('login_name' => $name));
    return $profile->getId();
  }
  
  public static function isEditor()
  {
    return strstr(EDITOR_IDS, '|' . UserHelper::getName() . '|') !== false;
  }
  
  public static function isInvited($email)
  {
    try {
      new Invitation(array('email' => $email));
      return true;
    } catch (fNotFoundException $e) {
      return false;
    }
  }
  
  public static function requireProfile()
  {
    if (fRequest::isGet() && fAuthorization::checkLoggedIn() && !self::hasProfile())
    {
      fURL::redirect(SITE_BASE . '/profiles/new');
    }
  }
  
  public static function getNameByProfileId($profileId)
  {
    try {
      $profile = new Profile($profileId);
      return $profile->getLoginName();
    } catch (fNotFoundException $e) {
      return '';  // XXX
    }
  }
}
