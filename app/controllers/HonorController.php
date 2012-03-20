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
      $honor->setDescription(fRequest::get('description'));
      $honor->setCreatedAt(Util::currentTime());
      $honor->store();
      $this->ajaxReturn(array('result' => 'success', 'honor_id' => $honor->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function update($id)
  {
  }
  
  public function delete($id)
  {
  }
}
