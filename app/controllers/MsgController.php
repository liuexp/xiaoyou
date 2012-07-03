<?php
class MsgController extends ApplicationController
{
  public function inbox()
  {
    $profileId = UserHelper::getProfileId();
    $this->msg = fRecordSet::build('Msg', array('receiver=' =>$profileId), array('timestamp' => 'desc'), ACTIVITIES_LIMIT)->getRecords();
    $this->isInbox=true;
    $this->render('msg/index');
  }
  public function sent()
  {
    $profileId = UserHelper::getProfileId();
    $this->msg = fRecordSet::build('Msg', array('sender=' =>$profileId), array('timestamp' => 'desc'), ACTIVITIES_LIMIT)->getRecords();
    $this->isInbox=false;
    $this->render('msg/index');
  }
  
  public function create()
  {  
    try {
      $profileId = UserHelper::getProfileId();
      $msg = new Msg();
      $msg->setSender($profileId);
      $msg->setContent(trim(fRequest::get('msg-content')));
      $re=trim(fRequest::get('dest'));
      if (empty($re)){
	      $re=trim(fRequest::get('destre','integer'));
	      $x=new Profile($re);
	      $msg->setReceiver($re);
      }else {
      	$receiver=fRecordSet::build('Profile',array('login_name=' => $re ),array())->getRecord(0);
      	$msg->setReceiver($receiver->getId());
      }
      if (strlen($msg->getContent()) < 1) {
        throw new fValidationException('信息长度不能少于1个字符');
      }
      if (strlen($msg->getContent()) > 140) {
        throw new fValidationException('信息长度不能超过140个字符');
      }
      $msg->store();
      //Activity::fireNewTweet();
      fMessaging::create('success', 'create msg', '信息发送成功！');
    }catch(fNotFoundException $e) {
      fMessaging::create('failure', 'create msg', '该用户名不存在！');
    } catch (fException $e) {
      fMessaging::create('failure', 'create msg', $e->getMessage());
    }
    //fURL::redirect(SITE_BASE . '/inbox');
  }
  
  public function delete($id)
  {
    try {
      $msg = new Msg($id);
      if (UserHelper::getProfileId() != $msg->getReceiver() and !UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
      $msg->delete();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
}
