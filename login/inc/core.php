<?php
function login_check_credential($db, $username, $password)
{
  $result = $db->translatedQuery(
    'SELECT id,pass,salt,iter,email,display_name FROM users WHERE name=%s AND status=1', $username);
  $num_of_rows = $result->countReturnedRows();
  if ($num_of_rows > 0) {
    $row = $result->fetchRow();
    if (acm_userpass_check($row, $password)) {
      return $row;
    } else {
      return false;
    }
  }
  return false;
}

function login_authenticate($db, $username, $password)
{
  if ($row = login_check_credential($db, $username, $password)) {
    fAuthorization::setUserToken(array(
      'id' => $row['id'],
      'name' => $username,
      'email' => $row['email'],
      'display_name' => $row['display_name']
    ));
    return true;
  }
  return false;
}

function login_change_password($db, $user_id, $password)
{
  $h = acm_userpass_hash($password);
  $result = $db->translatedQuery(
    'UPDATE users SET pass=%s,salt=%s,iter=%i WHERE id=%i',
    $h['pass'], $h['salt'], $h['iter'], $user_id);
  return $result->countAffectedRows() > 0;
}

function login_get_referer($default_value)
{
  if (array_key_exists('HTTP_REFERER', $_SERVER)) {
    return $_SERVER['HTTP_REFERER'];
  }
  return $default_value;
}
