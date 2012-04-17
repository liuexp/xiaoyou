<?php
class Article extends fActiveRecord
{
  protected function configure()
  {
    fORMValidation::addStringReplacement($this, 'Title: Please enter a value', '请输入标题');
    fORMValidation::addStringReplacement($this, 'Content: Please enter a value', '请输入文章内容');
  }
  
  public function getShortTitle()
  {
    return mb_strimwidth($this->getTitle(), 0, 29, '...', 'UTF-8');
  }
  
  public function isNews()
  {
    return $this->getType() == 'news';
  }
  
  public function isRecent()
  {
    return $this->getCreatedAt()->gt(new fTimestamp('-4 day'));
  }
  
  public function getComments()
  {
    return fRecordSet::build('ArticleComment', array('article_id=' => $this->getId()), array('timestamp' => 'asc'));
  }
}
