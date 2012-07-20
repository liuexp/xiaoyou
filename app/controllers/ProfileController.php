<?php
class ProfileController extends ApplicationController
{
  public $contact_types = array('email', 'renren', 'weibo', 'douban', 'facebook', 'twitter', 'qq','mobile','tele','msn');
  public $start_years = array();
  public $class_number_map = array();
  public $students_map = array();
 
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
      $profile->setClassNumber(fRequest::get('class_number'));
      $profile->setStudentNumber(trim(fRequest::get('student_number')));
      if (strlen($profile->getStudentNumber()) && !preg_match('/^\d{10}$/', $profile->getStudentNumber())) {
        throw new fValidationException('学号必须为10位数字');
      }
      $profile->setBirthday(trim(fRequest::get('birthday')));
      $profile->setGender(fRequest::get('gender'));
      $profile->setLocation(trim(fRequest::get('location')));
      $profile->setPostNumber(trim(fRequest::get('post_number')));
      //$profile->setHometown(trim(fRequest::get('hometown')));
      //$profile->setHighSchool(trim(fRequest::get('high_school')));
      $profile->setMemorable(trim(fRequest::get('memorable')));
      $profile->setSubscription(trim(fRequest::get('subscription')));
      $profile->setDescription(trim(fRequest::get('description')));
      $profile->setPresentable(fRequest::get('presentable', 'boolean'));
      $profile->setAdvices(trim(fRequest::get('advices')));
      $profile->setContributes(trim(fRequest::get('contributes')));
      $profile->setWillGiveTalk(fRequest::get('will_give_talk', 'boolean'));
      $profile->setTalkTitle(trim(fRequest::get('talk_title')));
      $profile->setTalkIntro(trim(fRequest::get('talk_intro')));
      $profile->setPrivacyControl(trim(fRequest::get('privacy','int',0)));
      $profile->setCreatedAt(Util::currentTime());
      $profile->store();
      
      foreach ($this->contact_types as $type) {
        if (strlen(trim(fRequest::get($type)))) {
          $contact = new Contact();
          $contact->setProfileId($profile->getId());
          $contact->setType($type);
          $contact->setContent(trim(fRequest::get($type)));
          $contact->setCreatedAt(Util::currentTime());
          $contact->store();
        }
      }
      
      $this->db->query('COMMIT');
      Activity::fireNewProfile();
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
      $this->editable = ((UserHelper::getProfileId() == $this->profile->getId()) or UserHelper::isEditor());
      $this->is_owner = UserHelper::getProfileId() == $this->profile->getId();
      if(!(UserHelper::viewProfile($this->profile))){
		//throw new fValidationException('not allowed');
      }

      $this->is_allowed=UserHelper::viewProfile($this->profile);
      $this->username = $this->profile->getLoginName();
      $this->avatarfile = AVATAR_DIR . $this->username . '-avatar.jpg';
      $this->render('profile/show');
    } catch (fNotFoundException $e) {
      Slim::getInstance()->notFound();
    }
  }
  
  public function update($id)
  {
    try {
      $this->db = fORMDatabase::retrieve();
      $this->db->query('BEGIN');
      
      $profile = new Profile($id);
      if (UserHelper::getProfileId() != $profile->getId() and !UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
      $profile->setStartYear(fRequest::get('start_year'));
      $profile->setClassNumber(fRequest::get('class_number'));
      $profile->setStudentNumber(trim(fRequest::get('student_number')));
      $profile->setBirthday(trim(fRequest::get('birthday')));
      $profile->setGender(fRequest::get('gender'));
      $profile->setLocation(trim(fRequest::get('location')));
      $profile->setPostNumber(trim(fRequest::get('post_number')));
      //$profile->setHometown(trim(fRequest::get('hometown')));
      //$profile->setHighSchool(trim(fRequest::get('high_school')));
      $profile->setPrivacyControl(trim(fRequest::get('privacy','int',0)));
      $profile->setSubscription(trim(fRequest::get('subscription')));
      $profile->store();
      
      foreach ($profile->getContacts() as $contact) {
        $contact->delete();
      }
      
      foreach ($this->contact_types as $type) {
        if (strlen(trim(fRequest::get($type)))) {
          $contact = new Contact();
          $contact->setProfileId($profile->getId());
          $contact->setType($type);
          $contact->setContent(trim(fRequest::get($type)));
          $contact->setCreatedAt(Util::currentTime());
          $contact->store();
        }
      }
      
      $this->db->query('COMMIT');
      Activity::fireUpdateProfile();
      $this->ajaxReturn(array('result' => 'success', 'profile_id' => $profile->getId()));
    } catch (fException $e) {
      if (isset($this->db)) $this->db->query('ROLLBACK');
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
}
