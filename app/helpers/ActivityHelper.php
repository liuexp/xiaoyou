<?php
class ActivityHelper
{
  public static function action($type)
  {
    static $translations = array(
      'register' => '完成了注册',
      'new profile' => '创建了个人信息',
      'update profile' => '更新了个人信息',
      'update avatar' => '更新了头像',
      'new contact' => '添加了联系方式',
      'new experience' => '添加了个人经历',
      'new honor' => '添加了个人荣誉',
      'new paper' => '完善了论文发表情况',
      'update contact' => '更新了联系方式',
      'update experience' => '更新了个人经历',
      'update honor' => '更新了个人荣誉',
      'update paper' => '更新了论文发表情况',
      'invite' => '邀请了更多同学',
      'new tweet' => '发表了<a href="tweets">新微博</a>'
    );
    
    if (isset($translations[$type])) {
      return $translations[$type];
    }
    return $type;
  }
}
