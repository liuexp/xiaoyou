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
		  1 => '党政机关(含国家事业单位)',
		  2=> '法官',
		  3=> '检察官',
		  4=> '律师',
		  5=>'企业法务(含国企)',
		  6=>'学界',
		  7=>'交大在职',
		  8=>'其他'
	  );
	  if (empty($x))return $x;
	  if (isset($trans[$x]))return $trans[$x];
	  else return $x;
  }

  public static function getProvinceName($x){
	  static $trans = array(
1=>'直辖市',
2=>'河北',
3=>'山西',
4=>'内蒙古',
5=>'辽宁',
6=>'吉林',
7=>'黑龙江',
8=>'江苏',
9=>'浙江',
10=>'安徽',
11=>'福建',
12=>'江西',
13=>'山东',
14=>'河南',
15=>'湖北',
16=>'湖南',
17=>'广东',
18=>'广西',
19=>'海南',
20=>'四川',
21=>'贵州',
22=>'云南',
23=>'西藏',
24=>'陕西',
25=>'甘肃',
26=>'青海',
27=>'宁夏',
28=>'新疆',
29=>'台湾'
);
	  if (empty($x))return $x;
	  if (isset($trans[$x]))return $trans[$x];
	  else return $x;
  }

  public static function splitLocation($x){
	  $y = preg_split("/([\x{7701}\x{5E02}])/u",$x);
	  if (count($y)<2&&count($y)){
		  return array(0=>'直辖市',1=>$y[0]);
	  }else if(count($y)) return $y;
	  else return null;
  }
}
