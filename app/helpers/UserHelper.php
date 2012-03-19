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
}
