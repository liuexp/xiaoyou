<?php
class Honor extends fActiveRecord
{
  protected function configure()
  {
    fORMValidation::addStringReplacement($this, 'Description: Please enter a value', '请填写荣誉描述');
  }
  
  public function getFormattedDate()
  {
    $date = $this->getYear();
    if (strlen($this->getMonth())) {
      $date .= '-' . $this->getMonth();
    }
    return $date;
  }
}
