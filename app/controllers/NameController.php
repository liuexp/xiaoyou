<?php
class NameController extends ApplicationController
{
  public function index()
  {  
    if (!UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
	$this->users = fRecordSet::build(
        'Name', array('registered=' => 0), array('id' => 'desc', 'student_number' => 'asc'));
    $this->render('users/index');
  }
  
  public function showKnown()
  {
      if (!UserHelper::isEditor()) {
	throw new fValidationException('not allowed');
      }

      $this->users = fRecordSet::build(
        'Name', array('registered=' => 0), array('student_number' => 'asc'));
    $this->render('users/known');
  }
 
  public function create()
  {
    try {
      $users = new Name();
      $users->setStudentNumber(fRequest::get('stuid'));
      $users->setRealname(fRequest::get('realname'));
      $users->store();
      $this->ajaxReturn(array('result' => 'success', 'user_id' => $users->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function edit($id)
  {
    $this->users = new Name($id);
    $this->render('users/edit');
  }
  
  public function update($id)
  {
    try {
      $users = new Name($id);
      if (!UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
	$users->setStudentNumber(fRequest::get('stuid'));
      $users->setRealname(fRequest::get('realname'));
      $users->store();
      $this->ajaxReturn(array('result' => 'success', 'user_id' => $users->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function delete($id)
  {
    try {
      $users = new Name($id);
      if (!UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
      $users->delete();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
 
}
