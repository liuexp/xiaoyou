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

  public static function existid($realname,$stuid)
  {
    return fRecordSet::build('Name', array('realname=' => $realname,'student_number=' => $stuid, 'registered=' => 0 ))->count() > 0;
  }

  public static function markRegistered($realname,$stuid){
    try {
/*	$userid=fRecordSet::build('Name', array('student_number=' => $stuid,'realname'=>$realname))->getRecord(0)->getId();
      $user = new Name($userid);
      $user->delete();
 */
	    $user = fRecordSet::build('Name', array('student_number=' => $stuid,'realname='=>$realname))->getRecord(0);
	    $user-> setRegistered(1);
	   $user->store(); 
    } catch (Exception $e) {
      // do nothing
    }

  }

}
