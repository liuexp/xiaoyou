<?php
class PaperController extends ApplicationController
{
  public function create()
  {
    try {
      $paper = new Paper();
      $paper->setProfileId(UserHelper::getProfileId());
      $paper->setTitle(trim(fRequest::get('title')));
      $paper->setAuthors(trim(fRequest::get('authors')));
      $paper->setPublishPlace(trim(fRequest::get('publish_place')));
      $paper->setPublishYear(fRequest::get('publish_year'));
      $paper->setIsFirstAuthor(fRequest::get('is_first_author', 'boolean'));
      $paper->setCreatedAt(Util::currentTime());
      $paper->store();
      $this->ajaxReturn(array('result' => 'success', 'paper_id' => $paper->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function update($id)
  {
  }
  
  public function delete($id)
  {
    try {
      $paper = new Paper($id);
      if (UserHelper::getProfileId() != $paper->getProfileId()) {
        throw new fValidationException('not allowed');
      }
      $paper->delete();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
}
