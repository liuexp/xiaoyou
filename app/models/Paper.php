<?php
class Paper extends fActiveRecord
{
  protected function configure()
  {
    fORMValidation::addStringReplacement($this, 'Title: Please enter a value', '请填写标题');
    fORMValidation::addStringReplacement($this, 'Authors: Please enter a value', '请填写作者列表');
    fORMValidation::addStringReplacement($this, 'Publish Place: Please enter a value', '请填写论文发表在哪里');
  }
}
