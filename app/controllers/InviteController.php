<?php
class InviteController extends ApplicationController
{
  public function show()
  {
    $this->render('invite/show');
  }
  
  public function submit()
  {
    try {
      $emails = array_unique(array_filter(array_map('trim', explode("\n", fRequest::get('emails'))), 'strlen'));
      foreach ($emails as $email)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
          throw new fValidationException($email . '不是一个合法的Email地址');
      // all emails are valid now
      foreach ($emails as $email)
        if (UserHelper::isInvited($email))
          throw new fValidationException($email . '已经被邀请过了');
      // all emails are not invited
      // note that registered users still have invitation left in the table
      // so this checking guarantees no duplicate emails
      $invitecodes = array();
      foreach ($emails as $email)
        $invitecodes[] = substr(md5(md5($email . time()) . rand()), 0, 10);
      $this->db = fORMDatabase::retrieve();
      $this->db->query('BEGIN');
      try {
        $inviter_profile_id = UserHelper::getProfileId();
      } catch (fNotFoundException $e) {
        throw new fValidationException('邀请同学之前必须填写好个人信息（<a href="'.SITE_BASE.'/profiles/new">点击这里</a>）');
      }
      foreach ($emails as $i => $email) {
        $invitation = new Invitation();
        $invitation->setEmail($email);
        $invitation->setInvitecode($invitecodes[$i]);
        $invitation->setIsMailSent(0);
        $invitation->setUserRegistered(0);
        $invitation->setInviterProfileId($inviter_profile_id);
        $invitation->setCreatedAt(Util::currentTime());
        $invitation->store();
      }
      $this->db->query('COMMIT');
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      if (isset($this->db)) $this->db->query('ROLLBACK');
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
}
