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
      $email = trim(fRequest::get('email'));
      $stuid = trim(fRequest::get('stuid','integer',0));
      $realname = trim(fRequest::get('realname'));
      // account information
      $username = trim(fRequest::get('username'));
      $password = fRequest::get('password');
      $confirm = fRequest::get('confirm');
      
      if (empty($email))
        throw new fValidationException('请填入Email地址');
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        throw new fValidationException('请填入合法的Email地址');
      if (empty($stuid))
	      throw new fValidationException('请填入学号');
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
      if (strlen($username) < 3)
        throw new fValidationException('用户名太短（至少为3个字符）');
      if (strlen($username) > 80)
        throw new fValidationException('用户名太长（最多80个字符）');
      if (!preg_match('/^[a-z0-9]+$/', $username))
        throw new fValidationException('用户名中只允许出现小写字母和数字');
      if (!Name::existid($realname,$stuid))
        throw new fValidationException('无效的用户信息（请务必填写用于注册的本科学号，并使用中文姓名注册）');
     
      $h = acm_userpass_hash($password);
      try {
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
      } catch (fException $e) {
        throw new fValidationException('用户名已存在，或该邮件地址已经注册过');
      }
      //Invitation::markRegistered($email, $invitecode);
      Name::markRegistered($realname,$stuid);
      Activity::fireRegister();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
}
