<?php
class TweetHelper
{
  public static function replaceEmotion($content)
  {
    return preg_replace_callback('/\((\w+)\)/', function ($matches) {
      return '<img src="' . SITE_BASE . '/images/emotions/' . $matches[1] . '.gif"/>';
    }, $content);
  }
  
  public static function sort(&$tweets)
  {
    $n = count($tweets);
    for ($i = 0; $i < $n; $i++)
      for ($j = $i + 1; $j < $n; $j++)
        if ($tweets[$i]->getReplyTimestamp()->lt($tweets[$j]->getReplyTimestamp())) {
          $t = $tweets[$i];
          $tweets[$i] = $tweets[$j];
          $tweets[$j] = $t;
        }
  }
}
