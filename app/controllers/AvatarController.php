<?php
class AvatarController extends ApplicationController
{
  public function __construct()
  {
    $this->username = UserHelper::getName();
    $this->uploaddir = AVATAR_DIR;
    $this->uploadfile = $this->uploaddir . $this->username . '.jpg';
  }
  
  /**
   * Show uploaded image and use Jcrop
   */
  public function edit()
  {
    if (file_exists($this->uploadfile)) {
      $this->render('avatar/edit');
    } else {
      fMessaging::create('failure', 'upload avatar', '请先上传头像');
      fURL::redirect(SITE_BASE . '/profile/' . UserHelper::getProfileId());
    }
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
      if (self::isImage($_FILES['avatar-file']) && move_uploaded_file($_FILES['avatar-file']['tmp_name'], $this->uploadfile)) {
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
