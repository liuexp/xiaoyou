<?php
class ProfileController extends ApplicationController
{
  public $start_years = array();
  public $class_number_map = array();
  public $students_map = array();
  
  public function index()
  {
    $all_names = fRecordSet::build('Name');
    $this->start_years = NameHelper::getAllStartYears($all_names);
    foreach ($this->start_years as $start_year) {
      $this->class_number_map[$start_year] = NameHelper::getClassNumber($all_names, $start_year);
      $this->students_map[$start_year] = NameHelper::getStudents($all_names, $start_year);
    }
    $this->render('profile/index');
  }
  
  public function show($id)
  {
  }
  
  public function update($id)
  {
  }
}
