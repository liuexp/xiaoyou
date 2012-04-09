<?php
class TweetHelper
{
  public static function replaceEmotion($content)
  {
    return preg_replace_callback('/\((\w+)\)/', function ($matches) {
      return '<a href=' . SITE_BASE . '/images/emotions/' . $matches[1] . '.gif';
    }, $content);
  }
}
