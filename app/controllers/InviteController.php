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
          throw new fValidationException($email . ' is not a valid email address.');
      // all emails are valid now
      foreach ($emails as $email)
        if (UserHelper::isInvited($email))
          throw new fValidationException($email . ' has already been invited.');
      // all emails are not invited
      // note that registered users still have invitation left in the table
      // so this checking guarantees no duplicate emails
      $invitecodes = array();
      foreach ($emails as $email)
        $invitecodes[] = substr(md5(md5($email . time()) . rand()), 0, 10);
      $this->db = fORMDatabase::retrieve();
      $this->db->query('BEGIN');
      $inviter_profile_id = UserHelper::getProfileId();
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
