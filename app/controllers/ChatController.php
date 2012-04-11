<?php
class ChatController extends ApplicationController
{
  public $pollInterval = 5; // 5 seconds
  
  protected function getCache()
  {
    if (isset($this->cache)) return $this->cache;
    $memcache = new Memcache();
    $memcache->connect('localhost', 11211);
    return $this->cache = new fCache('memcache', $memcache);
  }
  
  protected function acquireLock()
  {
    // TODO
  }
  
  protected function releaseLock()
  {
    // TODO
  }
  
  public function index()
  {
    $this->render('chat/index');
  }
  
  public function showSendForm()
  {
    $this->render('chat/sendform');
  }
  
  public function sendMessage()
  {
    try {
      $message = new stdClass();
      $message->profileId = UserHelper::getProfileId(); // for link
      $message->loginName = UserHelper::getName();  // for avatar
      $message->displayName = UserHelper::getDisplayName(); // for display
      $message->content = trim(fRequest::get('message', 'string'));
    
      $this->acquireLock();
      $messages = $this->getCache()->get('chat-messages', array());
      $messages[] = $message;
      while (count($messages) > 50) array_shift($messages);
      $this->getCache()->set('chat-messages', $messages);
      $this->releaseLock();
      
      $this->ajaxReturn(array('result' => 'success'));
    } catch (Exception $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function listMessages()
  {
    $this->acquireLock();
    $users = $this->getCache()->get('chat-users', array());
    $users[] = UserHelper::getName();
    $this->getCache()->set('chat-users', $users);
    $this->releaseLock();
    
    $this->getCache()->set('chat-online-' . UserHelper::getName(), true, $this->pollInterval);
    $this->messages = $this->getCache()->get('chat-messages', array());
    $this->render('chat/messages');
  }
  
  public function listUsers()
  {
    $this->users = array();
    $this->acquireLock();
    foreach ($this->getCache()->get('chat-users', array()) as $user) {
      if ($this->getCache()->get("chat-online-$user", false)) {
        $this->users[] = $user;
      }
    }
    $this->getCache()->set('chat-users', $this->users);
    $this->releaseLock();
    $this->render('chat/users');
  }
}
