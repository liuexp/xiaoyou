<?php
class Activity extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public static function fireRegister()
  {
    $this->fire('register');
  }
  
  public static function fireNewProfile()
  {
    $this->fire('new profile');
  }
  
  public static function fireUpdateProfile()
  {
    $this->fire('update profile');
  }
  
  public static function fireUpdateAvatar()
  {
    $this->fire('update avatar');
  }
  
  public static function fireNewContact()
  {
    $this->fire('new contact');
  }
  
  public static function fireNewExperience()
  {
    $this->fire('new experience');
  }
  
  public static function fireNewHonor()
  {
    $this->fire('new honor');
  }
  
  public static function fireNewPaper()
  {
    $this->fire('new paper');
  }
  
  public static function fireUpdateContact()
  {
    $this->fire('update contact');
  }
  
  public static function fireUpdateExperience()
  {
    $this->fire('update experience');
  }
  
  public static function fireUpdateHonor()
  {
    $this->fire('update honor');
  }
  
  public static function fireUpdatePaper()
  {
    $this->fire('update paper');
  }
  
  public static function fireInvite()
  {
    $this->fire('invite');
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
