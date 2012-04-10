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
      $experience->setType(fRequest::get('type'));
      $experience->setMajor(fRequest::get('major'));
      $experience->setLocation(trim(fRequest::get('location')));
      $experience->setMentor(trim(fRequest::get('mentor')));
      $experience->setCreatedAt(Util::currentTime());
      $experience->store();
      Activity::fireNewExperience();
      $this->ajaxReturn(array('result' => 'success', 'experience_id' => $experience->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function edit($id)
  {
    $this->experience = new Experience($id);
    $this->render('experience/edit');
  }
  
  public function update($id)
  {
    try {
      $experience = new Experience($id);
      if (UserHelper::getProfileId() != $experience->getProfileId() and !UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
      $experience->setStartYear(fRequest::get('start_year'));
      $experience->setStartMonth(fRequest::get('start_month'));
      $experience->setEndYear(fRequest::get('end_year'));
      $experience->setEndMonth(fRequest::get('end_month'));
      $experience->setType(fRequest::get('type'));
      $experience->setMajor(fRequest::get('major'));
      $experience->setLocation(trim(fRequest::get('location')));
      $experience->setMentor(trim(fRequest::get('mentor')));
      $experience->store();
      Activity::fireUpdateExperience();
      $this->ajaxReturn(array('result' => 'success', 'experience_id' => $experience->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function delete($id)
  {
    try {
      $experience = new Experience($id);
      if (UserHelper::getProfileId() != $experience->getProfileId() and !UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
      $experience->delete();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
}
