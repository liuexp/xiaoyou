<?php
class MailController extends ApplicationController
{
  public function inbox()
  {
    $profileId = UserHelper::getProfileId();
    $this->mail = fRecordSet::build('Mail', array('receiver=' =>$profileId), array('timestamp' => 'desc'), ACTIVITIES_LIMIT)->getRecords();
    $this->isInbox=true;
    $this->render('mail/index');
  }
  public function sent()
  {
    $profileId = UserHelper::getProfileId();
    $this->mail = fRecordSet::build('Mail', array('sender=' =>$profileId), array('timestamp' => 'desc'), ACTIVITIES_LIMIT)->getRecords();
    $this->isInbox=false;
    $this->render('mail/index');
  }
  
  public function create()
  {  
    try {
      $profileId = UserHelper::getProfileId();
      $mail = new Mail();
      $mail->setSender($profileId);
      $mail->setContent(trim(fRequest::get('mail-content')));
      $re=trim(fRequest::get('dest'));
      if (empty($re)){
	      $re=trim(fRequest::get('destre','integer'));
	      $x=new Profile($re);
	      $mail->setReceiver($re);
      }else {
      	$receiver=fRecordSet::build('Profile',array('login_name=' => $re ),array())->getRecord(0);
      	$mail->setReceiver($receiver->getId());
      }
      if (strlen($mail->getContent()) < 1) {
        throw new fValidationException('信息长度不能少于1个字符');
      }
      if (strlen($mail->getContent()) > 140) {
        throw new fValidationException('信息长度不能超过140个字符');
      }
      $mail->store();
      //Activity::fireNewTweet();
      fMessaging::create('success', 'create mail', '信息发送成功！');
    } catch (fException $e) {
      fMessaging::create('failure', 'create mail', $e->getMessage());
    }
    fURL::redirect(SITE_BASE . '/inbox');
  }
  
  public function delete($id)
  {
    try {
      $mail = new Mail($id);
      if (UserHelper::getProfileId() != $mail->getReceiver() and !UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
      $mail->delete();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
}
