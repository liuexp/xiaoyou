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
  
  protected function refreshUsers()
  {
    $this->users = array();
    $this->acquireLock();
    foreach (array_unique($this->getCache()->get('chat-users', array())) as $user) {
      if ($this->getCache()->get("chat-online-$user", false)) {
        $this->users[] = $user;
      }
    }
    $this->getCache()->set('chat-users', $this->users);
    $this->releaseLock();
  }
  
  public function index()
  {
    $this->refreshUsers();
    $this->render('chat/index');
  }
  
  public function showSendForm()
  {
    $this->render('chat/sendform');
  }
  
  public function sendMessage()
  {
    try {
      usleep(500000);  // 0.5 seconds
      
      $message = new stdClass();
      $message->profileId = UserHelper::getProfileId(); // for link
      $message->loginName = UserHelper::getName();  // for avatar
      $message->displayName = UserHelper::getDisplayName(); // for display
      $message->content = trim(fRequest::get('message', 'string'));
      $message->timestamp = new fTimestamp();
      
      if (strlen($message->content) < 1) {
        throw new fValidationException('message content too short');
      }
      
      $this->acquireLock();
      $messages = $this->getCache()->get('chat-messages', array());
      $messages[] = $message;
      while (count($messages) > 50) array_shift($messages);
      $this->getCache()->set('chat-messages', $messages);
      $this->releaseLock();
    } catch (Exception $e) {
      // TODO
    }
    fURL::redirect(SITE_BASE . '/chat/sendform');
  }
  
  public function listMessages()
  {
    $this->render('chat/messages');
  }
  
  public function ajaxMessages()
  {
    $this->acquireLock();
    $users = $this->getCache()->get('chat-users', array());
    $users[] = UserHelper::getName();
    $this->getCache()->set('chat-users', $users);
    $this->releaseLock();
    
    $this->getCache()->set('chat-online-' . UserHelper::getName(), true, 3 * $this->pollInterval);
    $this->messages = $this->getCache()->get('chat-messages', array());
    $this->render('chat/ajax-messages');
  }
  
  public function listUsers()
  {
    $this->render('chat/users');
  }
  
  public function ajaxUsers()
  {
    $this->refreshUsers();
    $this->render('chat/ajax-users');
  }
}
