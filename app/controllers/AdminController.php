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
	$this->csv="姓名,性别,生日,手机,工作领域,现工作地区,工作单位,职务,在校学习专业,导师,邮政编码,注册时间\r\n";
	foreach($users as $u){
		$this->csv .= $u->getDisplayName().",".$u->getGender().",".$u->getBirthday().",".$u->getMobile().",".$u->getField().",".$u->getLocation().",".$u->getInstitute().",".$u->getPosition().",".$u->getMajor().",".$u->getMentor().",".$u->getPostNumber().",".$u->getCreatedAt() . "\r\n";
		//$this->csv .=$u->getDisplayName();
	}
    	$this->render('csv');
  }

  public function importUsers(){
	  try{
	 	 $raw=fRequest::get('content');
  	 	 $this->db = fORMDatabase::retrieve();
  	 	 $this->db->query('BEGIN');
	 	 foreach (explode("\n",$raw) as $i){
	 	         $j=explode("\t",$i);
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

}
