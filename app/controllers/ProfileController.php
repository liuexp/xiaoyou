<?php
class ProfileController extends ApplicationController
{
  public $start_years = array();
  public $class_number_map = array();
  public $students_map = array();
  
  public function index()
  {  
    $this->all_profiles = fRecordSet::build('Profile');
    $all_names = fRecordSet::build('Name');
    $this->start_years = NameHelper::getAllStartYears($all_names);
    foreach ($this->start_years as $start_year) {
      $this->class_number_map[$start_year] = NameHelper::getClassNumber($all_names, $start_year);
      $this->students_map[$start_year] = NameHelper::getStudents($all_names, $start_year);
    }
    $this->render('profile/index');
  }
  
  public function newProfile()
  {
    $this->render('profile/new');
  }
  
  public function create()
  {
    try {
      $this->db = fORMDatabase::retrieve();
      $this->db->query('BEGIN');
      
      $profile = new Profile();
      $profile->setLoginName(UserHelper::getName());
      $profile->setDisplayName(UserHelper::getDisplayName());
      $profile->setStudentNumber(trim(fRequest::get('student_number')));
      $profile->setStartYear(fRequest::get('start_year'));
      $profile->setBirthday(fRequest::get('birthday'));
      $profile->setGender(fRequest::get('gender'));
      $profile->setLocation(trim(fRequest::get('location')));
      $profile->setHometown(trim(fRequest::get('hometown')));
      $profile->setDescription(fRequest::get('description'));
      $profile->setCreatedAt(Util::currentTime());
      $profile->store();
      
      $contact = new Contact();
      $contact->setProfileId($profile->getId());
      $contact->setType('email');
      $contact->setContent(UserHelper::getEmail());
      $contact->setCreatedAt(Util::currentTime());
      $contact->store();
      
      $this->db->query('COMMIT');
      $this->ajaxReturn(array('result' => 'success', 'profile_id' => $profile->getId()));
    } catch (fException $e) {
      if (isset($this->db)) $this->db->query('ROLLBACK');
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function show($id)
  {
    try {
      $this->profile = new Profile($id);
      $this->editable = UserHelper::getProfileId() == $this->profile->getId();
      $this->render('profile/show');
    } catch (fNotFoundException $e) {
      Slim::getInstance()->notFound();
    }
  }
  
  public function update($id)
  {
  }
}
