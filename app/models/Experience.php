<?php
class Experience extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public function getFormattedTimePeriod()
  {
    if (strlen($this->getEndDate())) {
      return $this->getStartDate() . '至' . $this->getEndDate();
    }
    return $this->getStartDate() . '至今';
  }
  
  public function getFormattedType()
  {
    if ($this->getType() == 'bachelor') return '本科';
    if ($this->getType() == 'master') return '硕士';
    if ($this->getType() == 'doctor') return '博士';
    if ($this->getType() == 'postdoc') return '博士后';
    return '工作';
  }
  
  public function getStartDate()
  {
    if (strlen($this->getStartMonth())) {
      return $this->getStartYear() . '-' . $this->getStartMonth();
    }
    return $this->getStartYear();
  }
  
  public function getEndDate()
  {
    if (strlen($this->getEndYear())) {
      if (strlen($this->getEndMonth())) {
        return $this->getEndYear() . '-' . $this->getEndMonth();
      }
      return $this->getEndYear();
    }
    return "";
  }
}
