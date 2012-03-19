<?php
class Honor extends fActiveRecord
{
  protected function configure()
  {
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
