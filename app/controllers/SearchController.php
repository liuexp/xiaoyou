<?php
class SearchController extends ApplicationController
{
  public function index()
  {  
    $this->editable = UserHelper::isEditor();
    $this->field="";
    $this->start_year="";
    $this->major="";
    $this->location="";
    $this->words="";
    $this->render('search/index');
  }
  
  public function show()
  {
    $this->editable = UserHelper::isEditor();
    $cons=array();
    $field=trim(fRequest::get('field'));
    $start_year=trim(fRequest::get('start_year'));
    $major=trim(fRequest::get('major'));
    $location=trim(fRequest::get('location'));
    $words=trim(fRequest::get('words'));
    $cons['login_name|display_name~']=$words;
    if(!empty($field))$cons['field=']=$field;
    if(!empty($start_year))$cons['start_year=']=$start_year;
    if(!empty($major))$cons['major=']=$major;
    if(!empty($location))$cons['location=']=$location;
    $this->users = fRecordSet::build(
        'Profile', $cons, array('id' => 'asc'));
    
    $this->field=$field;
    $this->start_year=$start_year;
    $this->major=$major;
    $this->location=$location;
    $this->words=$words;
    $this->render('search/index');
  }
 }
