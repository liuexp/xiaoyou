<?php
class NameHelper
{
  public static function getAllStartYears($all)
  {
    $years = array();
    foreach ($all as $name) $years[] = $name->getStartYear();
    return array_unique($years);
  }
  
  public static function getClassNumber($all, $start_year)
  {
    foreach ($all as $name)
      if ($name->getStartYear() == $start_year)
        return $name->getClassNumber();
    return "";
  }
  
  public static function getStudents($all, $start_year)
  {
    $students = array();
    foreach ($all as $name)
      if ($name->getStartYear() == $start_year)
        $students[] = $name;
    return $students;
  }
}
