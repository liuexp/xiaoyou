<?php
class ArticleController extends ApplicationController
{
  public function index()
  {  
    $this->editable = UserHelper::isEditor();
    if ($this->editable) {
      $this->articles = fRecordSet::build(
        'Article', array('type=' => 'news'), array('priority' => 'desc', 'created_at' => 'asc'));
    } else {
      $this->articles = fRecordSet::build(
        'Article', array('type=' => 'news', 'visible=' => 1), array('priority' => 'desc', 'created_at' => 'asc'));
    }
    $this->render('article/index');
  }
  
  public function showPosts()
  {
    $this->editable = UserHelper::isEditor();
    if ($this->editable) {
      $this->articles = fRecordSet::build(
        'Article', array('type=' => 'post'), array('created_at' => 'asc'));
    } else {
      $this->articles = fRecordSet::build(
        'Article', array('type=' => 'post', 'visible=' => 1), array('created_at' => 'asc'));
    }
    $this->render('article/posts');
  }
  
  public function show($id)
  {
    try {
      $this->article = new Article($id);
      if ($this->article->isNews()) {
        $this->render('article/show');
      } else {
        $this->render('article/show_post');
      }
    } catch (fNotFoundException $e) {
      Slim::getInstance()->notFound();
    }
  }
  
  public function showSchedule()
  {
    $this->show(SCHEDULE_ARTICLE_ID);
  }
  
  public function showCorresponds()
  {
    $this->show(CORRESPONDS_ARTICLE_ID);
  }
  
  public function showCredits()
  {
    $this->show(CREDITS_ARTICLE_ID);
  }
  
  public function create()
  {
    try {
      $article = new Article();
      $article->setType(fRequest::get('type'));
      $article->setTitle(fRequest::get('title'));
      $article->setContent(fRequest::get('content'));
      $article->setPriority(fRequest::get('priority', 'integer'));
      $article->setVisible(fRequest::get('visible', 'boolean'));
      $article->setCreatedAt(Util::currentTime());
      $article->store();
      $this->ajaxReturn(array('result' => 'success', 'article_id' => $article->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function edit($id)
  {
    $this->article = new Article($id);
    $this->render('article/edit');
  }
  
  public function update($id)
  {
    try {
      $article = new Article($id);
      if (!UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
      $article->setType(fRequest::get('type'));
      $article->setTitle(fRequest::get('title'));
      $article->setContent(fRequest::get('content'));
      $article->setPriority(fRequest::get('priority', 'integer'));
      $article->setVisible(fRequest::get('visible', 'boolean'));
      $article->store();
      $this->ajaxReturn(array('result' => 'success', 'article_id' => $article->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
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
  
  public function reply($id)
  {
    try {
      $article = new Article($id);
      $comment = new ArticleComment();
      $comment->setArticleId($article->getId());
      $comment->setProfileId(UserHelper::getProfileId());
      $comment->setContent(trim(fRequest::get('article-comment')));
      if (strlen($comment->getContent()) < 1) {
        throw new fValidationException('回复长度不能少于1个字符');
      }
      if (strlen($comment->getContent()) > 240) {
        throw new fValidationException('回复长度不能超过240个字符');
      }
      $comment->store();
      fMessaging::create('success', 'create article comment', '成功发表评论！');
      fURL::redirect(SITE_BASE . '/article/' . $id . '#comment-' . $comment->getId());
    } catch (fException $e) {
      fMessaging::create('failure', 'create article comment', $e->getMessage());
      fURL::redirect(SITE_BASE . '/article/' . $id . '#comment-form');
    }
  }
}
