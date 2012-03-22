<?php
class Article extends fActiveRecord
{
  protected function configure()
  {
    fORMValidation::addStringReplacement($this, 'Title: Please enter a value', '请输入标题');
    fORMValidation::addStringReplacement($this, 'Content: Please enter a value', '请输入文章内容');
  }
}
