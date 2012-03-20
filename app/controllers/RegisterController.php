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
        throw new fValidationException('请填入Email地址');
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        throw new fValidationException('请填入合法的Email地址');
      if (empty($invitecode))
        throw new fValidationException('请填入邀请码');
      if (empty($realname))
        throw new fValidationException('请填入真实姓名');
      if (empty($username))
        throw new fValidationException('请填入用户名');
      if (empty($password))
        throw new fValidationException('请填入密码');
      if (empty($confirm))
        throw new fValidationException('请确认密码');
      if ($password != $confirm)
        throw new fValidationException('两次输入的密码不一致');
      if (strlen($password) < 8)
        throw new fValidationException('密码太短（至少为8个字符）');
      if (strlen($username) < 4)
        throw new fValidationException('用户名太短（至少为4个字符）');
      if (strlen($username) > 80)
        throw new fValidationException('用户名太长（最多80个字符）');
      if (!preg_match('/^[a-z0-9]+$/', $username))
        throw new fValidationException('用户名中只允许出现小写字母和数字');
      if (!Invitation::isValid($email, $invitecode, $realname))
        throw new fValidationException('无效的邀请信息');
      
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
