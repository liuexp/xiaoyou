<?php
class ExperienceController extends ApplicationController
{
  public function create()
  {
    try {
      $experience = new Experience();
      $experience->setProfileId(UserHelper::getProfileId());
      $experience->setStartYear(fRequest::get('start_year'));
      $experience->setStartMonth(fRequest::get('start_month'));
      $experience->setEndYear(fRequest::get('end_year'));
      $experience->setEndMonth(fRequest::get('end_month'));
      $experience->setLocation(fRequest::get('location'));
      $experience->setDescription(fRequest::get('description'));
      $experience->setCreatedAt(Util::currentTime());
      $experience->store();
      $this->ajaxReturn(array('result' => 'success', 'experience_id' => $experience->getId()));
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
