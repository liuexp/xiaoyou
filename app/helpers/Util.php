<?php
class Util
{
  public static function currentTime()
  {
    return date('Y-m-d H:i:s');
  }
  
  public static function currentDate()
  {
    return date('Y-m-d');
  }
  
  public static function currentYear()
  {
    return date('Y');
  }
  
  public static function startsWith($haystack, $needle)
  {
    $length = strlen($needle);
    return substr($haystack, 0, $length) === $needle;
  }

  public static function endsWith($haystack, $needle)
  {
    $length = strlen($needle);
    $start  = $length * -1; // negative
    return substr($haystack, $start) === $needle;
  }
  
  public static function ensurePrefix($prefix, $str)
  {
    if (self::startsWith($str, $prefix)) return $str;
    return $prefix . $str;
  }

  public static function getFieldName($x){
	  static $trans = array(
		  1 => '党政机关（含国家事业单位）',
		  2=> '法官',
		  3=> '检察官',
		  4=> '律师',
		  5=>'企业法务（含国企）',
		  6=>'学界',
		  7=>'交大在职',
		  8=>'其他'
	  );

	  if(isset($trans[$x]))return $trans[$x];
	  else return $x;
  }
}
