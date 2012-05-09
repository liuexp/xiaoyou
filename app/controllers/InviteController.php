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
    fSession::close();
    set_time_limit(0);
    print "<pre>\n";
    print "Use ?force=true to resend invitations\n";
    if (fRequest::get('force', 'boolean')) {
      $invitations = fRecordSet::build('Invitation', array('user_registered=' => 0));
    } else {
      $invitations = fRecordSet::build('Invitation', array('user_registered=' => 0, 'is_mail_sent=' => 0));
    }
    foreach ($invitations as $invitation) {
      try {
        $this->sendInvitation($invitation->getEmail(), $invitation->getInvitecode());
        $invitation->setIsMailSent(1);
        $invitation->store();
        print 'Sent invitation mail to ' . $invitation->getEmail() . "\n";
      } catch (Exception $e) {
        print "Error occurred when processing invitation(id=" . $invitation->getId() . "): " . $e->getMessage() . "\n";
      }
      flush();
    }
  }
  
  protected function sendInvitation($email, $invitecode)
  {
    $admin_email = ADMIN_EMAIL;
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $command = <<<EEE
mail -s "上海交通大学ACM班十周年庆典系列活动邀请函" -a "From: noreply@acm.sjtu.edu.cn" -a "Reply-To: ${admin_email}" ${email} <<EOF
ACM班校友、同学：

　　您好！我们诚挚地邀请您于百忙之中参加上海交通大学ACM班
十周年庆典系列活动。

　　以培养计算机科学家为宗旨的ACM班，于2002年成立。十年来，
在学校的领导下，ACM班得到了各界的鼎力支持与帮助，同时凭借
ACM班全体师生的共同努力，取得了显著成效，得到了社会好评，
国际声誉不断提升。

　　值此十年之际，我们将于2012年6月9-10日举办上海交通大学
ACM班十周年庆典系列活动，旨在感谢这十年来风雨同舟一同走过
的人们。没有你们的倾力相助和不懈努力，ACM班就没有今天的成
就！

　　本次活动以“感恩·梦想”为主题，诚邀所有从ACM班走出的学
子，在ACM班成长过程中帮助过我们的，以及今后有志于和ACM班
共谋发展的人一起来到这里，聆听我们的故事，感悟人生的经历，
回馈母校的培育，践行未来的梦想。望所有ACM班人“无望饮水思
源意，有待乘风破浪时”。我们在此，恭候您的到来！

　　您可以通过访问 http://xiaoyou.acm-project.org/register
并使用我们提供给您的邀请码（${invitecode}）注册ACM班校友录。
在注册并完善您的个人信息后，您也可以看到其他同学的近况与
动态。

　　祝您生活愉快，身体健康，万事如意！

　　此致

敬礼！


　　　　　　　　　　　　　　　　上海交通大学ACM班
　　　　　　　　　　　　　　　　　${year}年${month}月${day}日

---
此邮件为系统自动发送，关于网站使用方面的任何问题，请回复本邮件至
管理员（${admin_email}）；请勿回复至noreply@acm.sjtu.edu.cn，
谢谢您的配合！

*** In case you cannot read this email due to character encoding 
issues, please contact the site administrator via ${admin_email}

EOF
EEE;
    system($command, $retval);
    if ($retval) {
      throw new Exception('An error occurred while sending the email: return value is ' . $retval);
    }
    flush();
    sleep(1); // wait for 1 seconds (do NOT send mail too frequently)
  }
  
  public function prepareNoticeEmails()
  {
    if (!UserHelper::isEditor()) throw fValidationException('not allowed');
    fSession::close();
    set_time_limit(0);
    print "<pre>\n";
    $emails = array();
    $profiles = fRecordSet::build('Profile');
    foreach ($profiles as $profile) {
      $emails[] = $profile->getEmail();
    }
    $emails = array_filter(array_unique($emails), 'strlen');
    print_r($emails);
    print "</pre>\n";
    print "<form method=\"POST\"><input type=\"submit\"/></form>";
  }
  
  public function sendNoticeEmails()
  {
    if (!UserHelper::isEditor()) throw fValidationException('not allowed');
    fSession::close();
    set_time_limit(0);
    print "<pre>\n";
    $emails = array();
    $profiles = fRecordSet::build('Profile');
    foreach ($profiles as $profile) {
      $emails[] = $profile->getEmail();
    }
    $emails = array_unique($emails);
    foreach ($emails as $email) {
      try {
        $this->sendTuring0509Notice($email);
        print 'Sent notice mail to ' . $email . "\n";
      } catch (Exception $e) {
        print "Error occurred when sending mail to $email: " . $e->getMessage() . "\n";
      }
      flush();
    }
  }
  
  protected function sendTuring0509Notice($email)
  {
    $admin_email = ADMIN_EMAIL;
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $command = <<<EEE
mail -s "[5月9日] 铜像捐款的最新进展" -a "From: noreply@acm.sjtu.edu.cn" -a "Reply-To: ${admin_email}" ${email} <<EOF
各位同学：

　　图灵铜像的捐赠倡议得到了大家积极的响应。截止到现在今日，大家一齐募集的款项已经达到了预期的目标，在此感谢各位的大力支持！

　　我们预备于北京时间5月10日晚上关闭筹款账号，希望大家不要在这个时间节点之后再进行汇款了。之后我们会清点每笔款项的来源，并公布每笔捐款的数额和时间，私下核对捐赠者的姓名。多出的款项数额不大，作何用途可以一起探讨研究。
 　　又，十周年征文集的初稿已经提交给上海交通大学出版社了。由于几位任课老师的文章还在创作之中，所以现在还来得及投稿，这周末无论如何是最晚的时间了，具体可见

     http://xiaoyou.acm-project.org/posts


　　此致

敬礼！


　　　　　　　　　　　　　　ACM班十周年庆典活动筹备组
　　　　　　　　　　　　　　　　　${year}年${month}月${day}日

---
此邮件为系统自动发送，关于网站使用方面的任何问题，请回复本邮件至
管理员（${admin_email}）；请勿回复至noreply@acm.sjtu.edu.cn，
谢谢您的配合！

*** In case you cannot read this email due to character encoding 
issues, please contact the site administrator via ${admin_email}

EOF
EEE;
    system($command, $retval);
    if ($retval) {
      throw new Exception('An error occurred while sending the email: return value is ' . $retval);
    }
    flush();
    sleep(1); // wait for 1 seconds (do NOT send mail too frequently)
  }
  
  protected function sendTuring0429Notice($email)
  {
    $admin_email = ADMIN_EMAIL;
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $command = <<<EEE
mail -s "[4月29日] 征文和铜像制作细节公布" -a "From: noreply@acm.sjtu.edu.cn" -a "Reply-To: ${admin_email}" ${email} <<EOF
各位同学：

　　征文活动受到大家广泛支持，上海交通大学出版社决定将这些文章集结公开出版，印数在两三千册左右。编辑会将一些修改意见发给大家，如果还想赶在书截止之前投稿的同学，请务必于5月1日晚上12点之前将征文以如下方式发送给编辑：

http://xiaoyou.acm-project.org/article/88

　　铜像募捐活动的最新情况参见，目前捐款总额已超过了预期的一半，情况喜人：

http://xiaoyou.acm-project.org/article/124

　　关于铜像制作的细节，参见

http://xiaoyou.acm-project.org/article/113

　　等铜像的模型制作出来，我们在网站上及时上传照片的。

　　如果6月9号打算来现场参加活动的毕业同学，请快速前去网站登记，以便我们及时预订宾馆。

　　此致

敬礼！


　　　　　　　　　　　　　　ACM班十周年庆典活动筹备组
　　　　　　　　　　　　　　　　　${year}年${month}月${day}日

---
此邮件为系统自动发送，关于网站使用方面的任何问题，请回复本邮件至
管理员（${admin_email}）；请勿回复至noreply@acm.sjtu.edu.cn，
谢谢您的配合！

*** In case you cannot read this email due to character encoding 
issues, please contact the site administrator via ${admin_email}

EOF
EEE;
    system($command, $retval);
    if ($retval) {
      throw new Exception('An error occurred while sending the email: return value is ' . $retval);
    }
    flush();
    sleep(1); // wait for 1 seconds (do NOT send mail too frequently)
  }
  
  protected function sendTuring0421Notice($email)
  {
    $admin_email = ADMIN_EMAIL;
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $command = <<<EEE
mail -s "[4月21日] 图灵铜像的最新消息" -a "From: noreply@acm.sjtu.edu.cn" -a "Reply-To: ${admin_email}" ${email} <<EOF
各位同学：

　　自捐款倡议发起以来，已经赢得了大家的广泛关注。为方便讨论，我们推荐大家加入一个google group

　　https://groups.google.com/forum/?fromgroups#!forum/news-acm-sjtu

　　加入之后就可以收到来自news-acm-sjtu@googlegroups.com的信件了。加入这个群不需要任何验证，直接可以发言，但国内同学可能需要翻越防火前才能访问，建议使用google
group的邮件列表功能。

　　这两天我们得到了很多好消息。首先是图灵的侄子已经正式授权了铜像的制作许可。其次，2012图灵年纪念活动的组委会，也将我们的活动作为了纪念活动的一个重要组成部分。学校方面，张杰校长和其他老师都表示大力支持。他还说，交大校园里就应该摆放更多著名的科学家的纪念物，他准备计划组织学校部门研究如何在学校的重要路口安放这批铜像，而图灵铜像一定会是第一个出现的。

　　俞老师统计了第二份关于捐款的公报。截止当前，捐款总额已超过了7万人民币，详情请见

　　http://xiaoyou.acm-project.org/article/111

　　关于海外同学使用paypal捐款方法，郑煜昊来信提醒了我们适当的操作方法，详情请见

　　http://xiaoyou.acm-project.org/article/96

　　有同学询问铜像的制作进度，铜像是交由媒体设计学院一个很有经验的老师设计的，他连续工作了很多天，正在争取四月底把初稿制作出来，让大家先睹为快。

　　有同学询问款项的使用计划和铜像的制作计划，以及使用捐款的组织名称和性质，关于这些问题，我们会组织人员撰写报告，及时在网站公布的，最晚在下周公布。

　　最后感谢大家对十周年庆典的大力支持。

　　此致

敬礼！


　　　　　　　　　　　　　　ACM班十周年庆典活动筹备组
　　　　　　　　　　　　　　　　　${year}年${month}月${day}日

---
此邮件为系统自动发送，关于网站使用方面的任何问题，请回复本邮件至
管理员（${admin_email}）；请勿回复至noreply@acm.sjtu.edu.cn，
谢谢您的配合！

*** In case you cannot read this email due to character encoding 
issues, please contact the site administrator via ${admin_email}

EOF
EEE;
    system($command, $retval);
    if ($retval) {
      throw new Exception('An error occurred while sending the email: return value is ' . $retval);
    }
    flush();
    sleep(1); // wait for 1 seconds (do NOT send mail too frequently)
  }
  
  protected function sendDonateNotice($email)
  {
    $admin_email = ADMIN_EMAIL;
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $command = <<<EEE
mail -s "关于图灵铜像捐赠活动的最新消息" -a "From: noreply@acm.sjtu.edu.cn" -a "Reply-To: ${admin_email}" ${email} <<EOF
各位同学：

　　今年6月23日，是图灵诞辰100周年的纪念日。全世界范围内纪念图灵的
活动很多，尤其是在美国和英国高校的计算机系里。我们特地将一些信息汇
总形成了调查报告，请点击以下链接《关于世界各地纪念图灵活动的调研》：

　　http://xiaoyou.acm-project.org/article/108

　　这篇文章收集了包括美国、英国、法国、比利时、丹麦、瑞士等世界各
地高校对图灵的纪念建筑，经过调查，在中国的高校中，还没有任何针对图
灵的纪念物。所以这次捐助图灵铜像的活动得到了学校的大力支持。学校通
过一些渠道，已经联系上了图灵唯一在世的亲人（他的侄子），邀请他当天
来上海为图灵铜像揭幕。

　　铜像募捐活动从上周开始收到了大家的大力资助，为了保证捐款过程尽
量公开，俞勇老师会将捐款情况以简报的方式向大家公布，第一份简报请见

　　http://xiaoyou.acm-project.org/article/104

　　同时为了方便海外同学捐款，节约手续费，我们委托03级郑煜昊同学用
paypal代收捐款，最后一同打入捐款账号。如果方便使用paypal，可以联系
将款项打入dannyt1984@gmail.com，这个邮件地址也就是郑煜昊的email，
有事可以联系他。

　　感谢大家对十周年庆典的大力支持。

　　此致

敬礼！


　　　　　　　　　　　　　　ACM班十周年庆典活动筹备组
　　　　　　　　　　　　　　　　　${year}年${month}月${day}日

---
此邮件为系统自动发送，关于网站使用方面的任何问题，请回复本邮件至
管理员（${admin_email}）；请勿回复至noreply@acm.sjtu.edu.cn，
谢谢您的配合！

*** In case you cannot read this email due to character encoding 
issues, please contact the site administrator via ${admin_email}

EOF
EEE;
    system($command, $retval);
    if ($retval) {
      throw new Exception('An error occurred while sending the email: return value is ' . $retval);
    }
    flush();
    sleep(1); // wait for 1 seconds (do NOT send mail too frequently)
  }
  
  protected function sendPostsNotice($email)
  {
    $admin_email = ADMIN_EMAIL;
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $command = <<<EEE
mail -s "关于“我的故事”征文故事性的要求及征集大家的日志的通知" -a "From: noreply@acm.sjtu.edu.cn" -a "Reply-To: ${admin_email}" ${email} <<EOF
ACM班校友、同学：

　　征文活动已经进行了近半月，得到了大家的支持和踊跃投稿，文章已过40篇，在此深表感谢！

　　为了能够更好地体现“我的故事”的征文要求与目的，之后我们将鼓励大家发表带个人故事及个人心路历程之文章。

　　同时，考虑到大家平时有所感有所思喜欢记录在自己的博客中，所以鼓励大家将当时的日志直接发来作为征文，我们将优先刊登博文日志类文章。

　　感谢大家继续对征文活动的支持！关于投递征文的细节请访问 http://xiaoyou.acm-project.org/article/4

　　祝您生活愉快，身体健康，万事如意！

　　此致

敬礼！


　　　　　　　　　　　　　　ACM班十周年庆典活动筹备组
　　　　　　　　　　　　　　　　　${year}年${month}月${day}日

---
此邮件为系统自动发送，关于网站使用方面的任何问题，请回复本邮件至
管理员（${admin_email}）；请勿回复至noreply@acm.sjtu.edu.cn，
谢谢您的配合！

*** In case you cannot read this email due to character encoding 
issues, please contact the site administrator via ${admin_email}

EOF
EEE;
    system($command, $retval);
    if ($retval) {
      throw new Exception('An error occurred while sending the email: return value is ' . $retval);
    }
    flush();
    sleep(1); // wait for 1 seconds (do NOT send mail too frequently)
  }
  
  protected function sendVoteNotice($email)
  {
    $admin_email = ADMIN_EMAIL;
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $command = <<<EEE
mail -s "ACM班十周年纪念品创意征集启事" -a "From: noreply@acm.sjtu.edu.cn" -a "Reply-To: ${admin_email}" ${email} <<EOF
ACM班校友、同学：

　　ACM班十周年庆典的倒计时已经不到70天了，为了让这个日子更加有意义，筹备组将制作一批纪念品，让这个节日成为大家共同的回忆。前期遴选出的方案主要有以下几种：

　　　　1. 制作一枚“ACM班十周年庆典”的纪念摆设，水晶雕刻

　　　　2. 制作一枚“ACM班十周年庆典”的纪念章

　　　　3. 制作一个“ACM班十周年庆典”的纪念钥匙挂坠

　　　　4. 制作一个“ACM班十周年庆典”的纪念戒指，详情见 http://bbs.sjtu.edu.cn/bbstcon,board,Graduating,reid,1331655915.html

　　各位同学可以为自己支持的方案投票，也可以提出新的想法，详情请访问 http://xiaoyou.acm-project.org/article/24

　　祝您生活愉快，身体健康，万事如意！

　　此致

敬礼！


　　　　　　　　　　　　　　ACM班十周年庆典活动筹备组
　　　　　　　　　　　　　　　　　${year}年${month}月${day}日

---
此邮件为系统自动发送，关于网站使用方面的任何问题，请回复本邮件至
管理员（${admin_email}）；请勿回复至noreply@acm.sjtu.edu.cn，
谢谢您的配合！

*** In case you cannot read this email due to character encoding 
issues, please contact the site administrator via ${admin_email}

EOF
EEE;
    system($command, $retval);
    if ($retval) {
      throw new Exception('An error occurred while sending the email: return value is ' . $retval);
    }
    flush();
    sleep(1); // wait for 1 seconds (do NOT send mail too frequently)
  }
}
