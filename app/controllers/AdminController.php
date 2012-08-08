<?php
class AdminController extends ApplicationController
{
  public function index()
  {  
    if (!UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
    }
    $this->users = fRecordSet::build(
        'Name', array('registered=' => 0), array('id' => 'desc', 'student_number' => 'asc'));

    $uploadList=array();
    if ($handle = opendir(UPLOAD_DIR)) {
    	while (false !== ($entry = readdir($handle))) {
    	    if ($entry != "." && $entry != ".." && !is_dir(UPLOAD_DIR . $entry)) {
		    $uploadList[]=$entry;
    	    }
	}
    }
    closedir($handle);
    $this->uploadList=$uploadList;
    $this->render('admin/index');
  }
  public function exportCSV(){
      	if (!UserHelper::isEditor()) {
        	throw new fValidationException('not allowed');
      	}
	$users = fRecordSet::build(
        'Profile', array(), array('id' => 'desc', 'student_number' => 'asc'))->getRecords();
	$this->csv="姓名,性别,生日,手机,邮箱,工作领域,现工作地区,工作单位,职务,在校学习专业,导师,邮政编码,注册时间\r\n";
	foreach($users as $u){
		$this->csv .= $u->getDisplayName().",".$u->getGender().",".$u->getBirthday().",".$u->getMobile().",".$u->getEmail().",".$u->getField().",".$u->getLocation().",".$u->getInstitute().",".$u->getPosition().",".$u->getMajor().",".$u->getMentor().",".$u->getPostNumber().",".$u->getCreatedAt() . "\r\n";
		//$this->csv .=$u->getDisplayName();
	}
    	$this->render('csv');
  }
  public function exportXLS(){
      	if (!UserHelper::isEditor()) {
        	throw new fValidationException('not allowed');
      	}
	$users = fRecordSet::build(
        'Profile', array(), array('id' => 'desc', 'student_number' => 'asc'))->getRecords();
	$this->data=array(
		1=> array('姓名','性别','生日','手机','邮箱','工作领域','现工作地区','工作单位','职务','在校学习专业','导师','邮政编码','注册时间')
	);
	foreach($users as $u){
		$this->data[]=array($u->getDisplayName(),$u->getGender(),$u->getBirthday(),$u->getMobile(),$u->getEmail(),$u->getField(),$u->getLocation(),$u->getInstitute(),$u->getPosition(),$u->getMajor(),$u->getMentor(),$u->getPostNumber(),$u->getCreatedAt());
	}
    	$this->render('xls');
  }

  public function importUsers(){
	  try{
	 	 $raw=fRequest::get('content');
  	 	 $this->db = fORMDatabase::retrieve();
  	 	 $this->db->query('BEGIN');
	 	 foreach (explode("\n",$raw) as $i){
			 $j=preg_split('/\s+/', $i);
			 if (count($j) < 2) continue;
	 	         $x=$j[0];
	 	         $y=$j[1];
	 	         $user= new Name();
	 	         $user->setRealname($x);
	 	         $user->setStudentNumber($y);
	 	         $user->store();
	 	 }
	 	 $this->db->query('COMMIT');
	 	 $this->ajaxReturn(array('result' => 'success'));
	  } catch (fException $e) {
	      	 if (isset($this->db)) $this->db->query('ROLLBACK');
	         $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }



  public function upload()
  {
    $uploadfile = UPLOAD_DIR . basename($_FILES['userfile']['name']);
    try {
      if (self::validFile($uploadfile) && move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        fURL::redirect(SITE_BASE . '/manage');

      } else {
        throw new fValidationException('上传失败');
      }
    } catch (Exception $e) {
      fMessaging::create('failure', 'upload file', $e->getMessage());
      fURL::redirect(SITE_BASE . '/manage');
    }
  }

  public static function validFile($f){
	  $tmp = explode('.', $f);
	  $ext = strtolower(end($tmp));
	  return in_array($ext,unserialize(UPLOAD_EXT));
  }

  public function getmail(){
    $emails = array();

    $cons=array();
    $field=trim(fRequest::get('field'));
    $start_year=trim(fRequest::get('start_year'));
    $major=trim(fRequest::get('major'));
    $location=trim(fRequest::get('location'));
    $words=trim(fRequest::get('words'));
   
    $cons['login_name|display_name~']=$words;
    if(!empty($field))$cons['field=']=$field;
    if(!empty($start_year))$cons['start_year=']=$start_year;
    if(!empty($major))$cons['major=']=$major;
    if(!empty($location))$cons['location~']=$location;
    try{
	    $users = fRecordSet::build('Profile', $cons, array('id' => 'asc'));
     } catch (Exception $e) {
	    $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
     }
    foreach ($users as $profile) {
      $emails[] = $profile->getEmail();
    }
    $emails = array_filter(array_unique($emails), 'strlen');
    $this->ajaxReturn(array('result' => 'success','emails' => json_encode($emails)));
  }

  public function sendmail(){
    if (!UserHelper::isEditor()) throw fValidationException('not allowed');
    fSession::close();
    set_time_limit(0);
    print "<pre>\n";
    $emails = array();

    $cons=array();
    $field=trim(fRequest::get('field'));
    $start_year=trim(fRequest::get('start_year'));
    $major=trim(fRequest::get('major'));
    $location=trim(fRequest::get('location'));
    $words=trim(fRequest::get('words'));
    $title=trim(fRequest::get('mail-title'));
    $content=trim(fRequest::get('mail-content'));
    
    $cons['login_name|display_name~']=$words;
    if(!empty($field))$cons['field=']=$field;
    if(!empty($start_year))$cons['start_year=']=$start_year;
    if(!empty($major))$cons['major=']=$major;
    if(!empty($location))$cons['location~']=$location;
    $users = fRecordSet::build('Profile', $cons, array('id' => 'asc'));
    foreach ($users as $profile) {
      $emails[] = $profile->getEmail();
    }
    $emails = array_filter(array_unique($emails), 'strlen');
    foreach ($emails as $email) {
      try {
	self::send($email,$title,$content);
	print 'Sent notice mail to ' . $email . "\n";
      } catch (Exception $e) {
        print "Error occurred when sending mail to $email: " . $e->getMessage() . "\n";
      }
      flush();
    }
    print "<a href='javascript:history.go(-1);'>Go Back</a>\n";

  }

  public function sendmail1(){
    try {
	    if (!UserHelper::isEditor()) throw fValidationException('not allowed');
	    $emails=json_decode(trim(fRequest::get('emails')));
	    $title=trim(fRequest::get('title'));
	    $content=trim(fRequest::get('content'));
	    foreach ($emails as $email){
			self::send($email,$title,$content);
	    }
	    $this->ajaxReturn(array('result' => 'success'));
    } catch (Exception $e) {
         $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }

  }

  public static function send($email,$title,$content){
 	require_once(__DIR__ . '/../vendor/class.phpmailer.php');
 	require_once(__DIR__ . '/../vendor/class.smtp.php');
	//error_reporting(E_STRICT);
	date_default_timezone_set("Asia/Shanghai");//设定时区东八区
	$mail             = new PHPMailer(); //new一个PHPMailer对象出来
	$mail->CharSet ="UTF-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
	$mail->IsSMTP(); // 设定使用SMTP服务
	//$mail->SMTPDebug  = 2;                     // 启用SMTP调试功能
	                                       // 1 = errors and messages
	                                       // 2 = messages only
	$mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
	$mail->SMTPSecure = SMTP_PRO;                 // 安全协议
	$mail->Host       = SMTP_ADDR;
	$mail->Port       = SMTP_PORT;
	$mail->Username   = SMTP_USER;
	$mail->Password   = SMTP_PASS;
	$mail->SetFrom(ADMIN_EMAIL, ADMIN_EMAIL);
	$mail->AddReplyTo(ADMIN_EMAIL,ADMIN_EMAIL);
	$mail->Subject    = $title;
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer! "; // optional, comment out and test
	$mail->MsgHTML($content);
	$address = $email;
	$mail->AddAddress($address, "");
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment 
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	if(!$mail->Send()) {
	    //echo "Mailer Error: " . $mail->ErrorInfo . "\n";
		throw new Exception($mail->ErrorInfo);
	} else {
	    //echo "恭喜，邮件发送成功！";
	}
    flush();
    sleep(1); // wait for 1 seconds (do NOT send mail too frequently)
  }

  public static function cmd_send($email,$title,$content){
    $admin_email = ADMIN_EMAIL;
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $command = <<<EEE
mail -s "${title}"  ${email} <<EOF
${content}
EOF
EEE;
    echo passthru($command, $retval). "\n";
    if ($retval) {
      throw new Exception('An error occurred while sending the email: command '. $command . '\n  return value is ' . $retval);
    }
    flush();
    sleep(1); // wait for 1 seconds (do NOT send mail too frequently)
  }
}
