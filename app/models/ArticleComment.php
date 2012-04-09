<?php
class ArticleComment extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public function getProfile()
  {
    return new Profile($this->getProfileId());
  }
}
