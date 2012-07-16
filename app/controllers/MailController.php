<?php
class MailController extends ApplicationController
{
  public function inbox()
  {
    $profileId = UserHelper::getProfileId();
    $this->mail = fRecordSet::build('Mail', array('receiver=|sender=' =>array($profileId,$profileId), 'parent='=>-1), array('timestamp' => 'desc'))->getRecords();
    TweetHelper::sort($this->mail);
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
	      $pa=trim(fRequest::get('parent','integer',-1));
	      $x=new Profile($re);
	      $mail->setReceiver($re);
	      $mail->setParent($pa);
      }else {
      	//$receiver=fRecordSet::build('Profile',array('login_name=' => $re ),array())->getRecord(0);
	      $receiver=fRecordSet::build('Profile',array('login_name=' => $re ),array());
	      if($receiver->getCount()>0)$receiver=$receiver->getRecord(0);
	      else throw new fNotFoundException('user doesn\'t exist');
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
    }catch(fNotFoundException $e) {
      fMessaging::create('failure', 'create mail', '该用户名不存在,或该用户没有创建个人资料！');
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
      foreach ($mail->getReplies() as $re){
	      $re->delete();
      }
      $mail->delete();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
}
