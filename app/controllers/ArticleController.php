<?php
class ArticleController extends ApplicationController
{
  public function index()
  {
    $this->articles = fRecordSet::build('Article');
    $this->editable = UserHelper::isEditor();
    $this->render('article/index');
  }
  
  public function showSchedule()
  {
  }
  
  public function create()
  {
    try {
      $article = new Article();
      $article->setTitle(fRequest::get('title'));
      $article->setContent(fRequest::get('content'));
      $article->setCreatedAt(Util::currentTime());
      $article->store();
      $this->ajaxReturn(array('result' => 'success', 'article_id' => $article->getId()));
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
      $article = new Article($id);
      if (!UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
      $article->delete();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
}
