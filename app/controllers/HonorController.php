<?php
class HonorController extends ApplicationController
{
  public function create()
  {
    try {
      $honor = new Honor();
      $honor->setProfileId(UserHelper::getProfileId());
      $honor->setYear(fRequest::get('year'));
      $honor->setMonth(fRequest::get('month'));
      $honor->setDescription(trim(fRequest::get('description')));
      $honor->setCreatedAt(Util::currentTime());
      $honor->store();
      Activity::fireNewHonor();
      $this->ajaxReturn(array('result' => 'success', 'honor_id' => $honor->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function edit($id)
  {
    $this->honor = new Honor($id);
    $this->render('honor/edit');
  }
  
  public function update($id)
  {
    try {
      $honor = new Honor($id);
      if (UserHelper::getProfileId() != $honor->getProfileId()) {
        throw new fValidationException('not allowed');
      }
      $honor->setYear(fRequest::get('year'));
      $honor->setMonth(fRequest::get('month'));
      $honor->setDescription(trim(fRequest::get('description')));
      $honor->store();
      Activity::fireUpdateHonor();
      $this->ajaxReturn(array('result' => 'success', 'honor_id' => $honor->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function delete($id)
  {
    try {
      $honor = new Honor($id);
      if (UserHelper::getProfileId() != $honor->getProfileId()) {
        throw new fValidationException('not allowed');
      }
      $honor->delete();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
}
