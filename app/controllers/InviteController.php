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
      Activity::fireInvite();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      if (isset($this->db)) $this->db->query('ROLLBACK');
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function sendEmails()
  {
    if (!UserHelper::isEditor()) throw fValidationException('not allowed');
    print "<pre>\n";
    $invitations = fRecordSet::build('Invitation', array('user_registered=' => 0));
    foreach ($invitations as $invitation) {
      try {
        $this->sendInvitation($invitation->getEmail(), $invitation->getInvitecode());
        $invitation->setIsMailSent(1);
        $invitation->store();
        echo 'Sent invitation mail to ' . $invitation->getEmail() . "\n";
      } catch (Exception $e) {
        print "Error occurred when processing invitation(id=" . $invitation->getId() . "): " . $e->getMessage() . "\n";
      }
    }
  }
  
  protected function sendInvitation($email, $invitecode)
  {
    $admin_email = ADMIN_EMAIL;
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $command = <<<EEE
mail -s "上海交通大学ACM班十周年庆典系列活动邀请函" -a "From: noreply@acm.sjtu.edu.cn" -a "Reply-To: $admin_email" $email <<EOF
ACM班校友、同学：

　　您好！我们诚挚地邀请您于百忙之中参加上海交通大学ACM班十周年庆典系列活动。

　　以培养计算机科学家为宗旨的ACM班，于2002年成立。十年来，在学校的领导下，ACM班得到了各界的鼎力支持与帮助，同时凭借ACM班全体师生的共同努力，取得了显著成效，得到了社会好评，国际声誉不断提升。

　　值此十年之际，我们将于2012年6月9－10日举办上海交通大学ACM班十周年庆典系列活动，旨在感谢这十年来风雨同舟一同走过的人们。没有你们的倾力相助和不懈努力，ACM班就没有今天的成就！

　　本次活动以“感恩·梦想”为主题，诚邀所有从ACM班走出的学子，在ACM班成长过程中帮助过我们的，以及今后有志于和ACM班共谋发展的人一起来到这里，聆听我们的故事，感悟人生的经历，回馈母校的培育，践行未来的梦想。望所有ACM班人“无望饮水思源意，有待乘风破浪时”。我们在此，恭候您的到来！

　　您可以通过访问 http://xiaoyou.acm-project.org/register 并使用我们提供给您的邀请码（${invitecode}）注册ACM班校友录。在注册并完善您的个人信息后，您也可以看到其他同学的近况与动态。

　　祝您生活愉快，身体健康，万事如意！

　　此致

敬礼！


　　　　　　　　　　　　　　　　　　　　　　　　　　上海交通大学ACM班
　　　　　　　　　　　　　　　　　　　　　　　　　　　$year年$month月$day日

---
此邮件为系统自动发送，关于网站使用方面的任何问题，请回复本邮件至管理员（$admin_email）；请勿回复至noreply@acm.sjtu.edu.cn，谢谢您的配合！

EOF
EEE;
    system($command, $retval);
    if ($retval) {
      throw new Exception('An error occurred while sending the email: return value is ' . $retval);
    }
    sleep(3); // wait for 3 seconds (do NOT send mail too frequently)
  }
}
