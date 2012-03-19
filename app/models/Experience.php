<?php
class Experience extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public function getFormattedTimePeriod()
  {
    return "eee";
  }
}
