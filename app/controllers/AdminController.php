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

}
