<?php
function acm_userpass_iter()
{
  return rand(2, 16);
}

function acm_userpass_salt()
{
  return md5(uniqid(time(), true));
}

function acm_userpass_hash($password)
{
  $iter = acm_userpass_iter();
  $salt = acm_userpass_salt();
  $pass = $password;
  for ($i = 0; $i < $iter; $i++) {
    $pass .= $salt;
    $pass = md5($pass);
  }
  return array(
    'pass' => $pass,
    'salt' => $salt,
    'iter' => $iter,
  );
}

function acm_userpass_check($hash, $password)
{
  if (!array_key_exists('pass', $hash)) {
    return false;
  }
  if (!array_key_exists('salt', $hash)) {
    return false;
  }
  if (!array_key_exists('iter', $hash)) {
    return false;
  }
  $iter = $hash['iter'];
  $salt = $hash['salt'];
  $pass = $password;
  for ($i = 0; $i < $iter; $i++) {
    $pass .= $salt;
    $pass = md5($pass);
  }
  return $pass === $hash['pass'];
}
