<?php
class Activity extends fActiveRecord
{
  protected function configure()
  {
  }
  
  protected static function clearProfilesCache()
  {
    unlink(CACHE_PROFILES);
  }
  
  public static function fireRegister()
  {
    self::fire('register');
  }
  
  public static function fireNewProfile()
  {
    self::fire('new profile');
    self::clearProfilesCache();
  }
  
  public static function fireUpdateProfile()
  {
    self::fire('update profile');
  }
  
  public static function fireUpdateAvatar()
  {
    self::fire('update avatar');
    self::clearProfilesCache();
  }
  
  public static function fireNewContact()
  {
    self::fire('new contact');
  }
  
  public static function fireNewExperience()
  {
    self::fire('new experience');
  }
  
  public static function fireNewHonor()
  {
    self::fire('new honor');
  }
  
  public static function fireNewPaper()
  {
    self::fire('new paper');
  }
  
  public static function fireUpdateContact()
  {
    self::fire('update contact');
  }
  
  public static function fireUpdateExperience()
  {
    self::fire('update experience');
  }
  
  public static function fireUpdateHonor()
  {
    self::fire('update honor');
  }
  
  public static function fireUpdatePaper()
  {
    self::fire('update paper');
  }
  
  public static function fireInvite()
  {
    self::fire('invite');
  }
  
  /**
   * This function never fails.
   */
  protected static function fire($type)
  {
    try {
      $activity = new Activity();
      try {
        $activity->setProfileId(UserHelper::getProfileId());
      } catch (fException $e) {
        $activity->setProfileId(NULL);
      }
      $activity->setRealname(UserHelper::getDisplayName());
      $activity->setType($type);
      $activity->store();
    } catch (Exception $e) {
      // do nothing
    }
  }
}
