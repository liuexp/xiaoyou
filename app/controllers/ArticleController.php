<?php
class ArticleController extends ApplicationController
{
  public function index()
  {
    $this->articles = fRecordSet::build('Article');
    $this->editable = true; // TODO
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
  }
}
