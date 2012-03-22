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
      $profile->setStartYear(fRequest::get('start_year'));
      $profile->setStudentNumber(trim(fRequest::get('student_number')));
      $profile->setBirthday(trim(fRequest::get('birthday')));
      $profile->setGender(fRequest::get('gender'));
      $profile->setLocation(trim(fRequest::get('location')));
      $profile->setHometown(trim(fRequest::get('hometown')));
      $profile->setHighSchool(trim(fRequest::get('high_school')));
      $profile->setMemorable(trim(fRequest::get('memorable')));
      $profile->setDescription(trim(fRequest::get('description')));
      $profile->setPresentable(fRequest::get('presentable', 'boolean'));
      $profile->setAdvices(trim(fRequest::get('advices')));
      $profile->setContributes(trim(fRequest::get('contributes')));
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
      $this->username = UserHelper::getName();
      $this->avatarfile = AVATAR_DIR . $this->username . '-avatar.jpg';
      $this->render('profile/show');
    } catch (fNotFoundException $e) {
      Slim::getInstance()->notFound();
    }
  }
  
  public function update($id)
  {
    try {
      $profile = new Profile($id);
      if (UserHelper::getProfileId() != $profile->getId()) {
        throw new fValidationException('not allowed');
      }
      $profile->setStartYear(fRequest::get('start_year'));
      $profile->setStudentNumber(trim(fRequest::get('student_number')));
      $profile->setBirthday(trim(fRequest::get('birthday')));
      $profile->setGender(fRequest::get('gender'));
      $profile->setLocation(trim(fRequest::get('location')));
      $profile->setHometown(trim(fRequest::get('hometown')));
      $profile->setHighSchool(trim(fRequest::get('high_school')));
      $profile->store();
      $this->ajaxReturn(array('result' => 'success', 'profile_id' => $profile->getId()));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
}
