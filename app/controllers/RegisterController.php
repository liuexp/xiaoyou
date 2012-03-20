<?php
class RegisterController extends ApplicationController
{
  public function show()
  {
    $this->render('register/show');
  }
  
  public function submit()
  {
    try {
      // invitation information
      $email = fRequest::get('email');
      $invitecode = fRequest::get('invitecode');
      $realname = fRequest::get('realname');
      // account information
      $username = fRequest::get('username');
      $password = fRequest::get('password');
      $confirm = fRequest::get('confirm');
      
      if (empty($email))
        throw new fValidationException('Email address cannot be blank.');
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        throw new fValidationException('Email address is not valid.');
      if (empty($invitecode))
        throw new fValidationException('Invite code cannot be blank.');
      if (empty($realname))
        throw new fValidationException('Real name cannot be blank.');
      if (empty($username))
        throw new fValidationException('Login name cannot be blank.');
      if (empty($password))
        throw new fValidationException('Password cannot be blank.');
      if (empty($confirm))
        throw new fValidationException('Password confirmation cannot be blank.');
      if ($password != $confirm)
        throw new fValidationException('Passwords do not match. Please check it and confirm again.');
      if (strlen($password) < 8)
        throw new fValidationException('Your password is too short.');
      if (strlen($username) < 4)
        throw new fValidationException('Your login name is too short (minimum 4 characters).');
      if (strlen($username) > 80)
        throw new fValidationException('Your login name is too long (maximum 80 characters).');
      if (!preg_match('/^[a-z0-9]+$/', $username))
        throw new fValidationException('Only characters a-z and 0-9 are allowed in your login name.');
      if (!Invitation::isValid($email, $invitecode, $realname))
        throw new fValidationException('Invalid invitation information.');
      
      $h = acm_userpass_hash($password);
      $udb = new fDatabase('mysql', UDB_NAME, UDB_USER, UDB_PASS, UDB_HOST);
      $udb->translatedQuery(
        'INSERT INTO users(name,pass,salt,iter,status,email,display_name,created_at,updated_at)' .
        'VALUES(%s,%s,%s,%i,2,%s,%s,now(),now())',
        /**                 ^
         * Note that here we give them status=2 so they cannot log into other services such as giti.me
         * The login module of this application is also changed so we do not check whether status=1
         * So the users created here can only use this site
         */
        $username, $h['pass'], $h['salt'], $h['iter'], $email, $realname
      );
      Invitation::markRegistered($email, $invitecode);
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
}
