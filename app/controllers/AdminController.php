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



}
