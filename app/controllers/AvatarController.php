<?php
class AvatarController extends ApplicationController
{
  /**
   * Show uploaded image and use Jcrop
   */
  public function edit()
  {
  }
  
  /**
   * Crop image file and set coordinates
   */
  public function update()
  {
  }
  
  /**
   * Upload an image file for avatar
   */
  public function upload()
  {
    try {
      $uploaddir = AVATAR_DIR;
      $uploadfile = $uploaddir . UserHelper::getName() . '.jpg';
      if (self::isImage($_FILES['avatar-file']) && move_uploaded_file($_FILES['avatar-file']['tmp_name'], $uploadfile)) {
        fURL::redirect(SITE_BASE . '/avatar');
      } else {
        throw new fValidationException('上传图片失败');
      }
    } catch (Exception $e) {
      fMessaging::create('failure', 'upload avatar', $e->getMessage());
      fURL::redirect(SITE_BASE . '/profile/' . UserHelper::getProfileId());
    }
  }
  
  protected static function isImage($f)
  {
    return $f['type'] == 'image/jpeg' || $f['type'] == 'image/pjpeg';
  }
}
