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
  
  public static function isRegistered($student)
  {
    // TODO
    return (0 + $student->getStudentNumber()) % 2 == 0;
  }
  
  public static function getStudentProfileId($student)
  {
    // TODO
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
}
