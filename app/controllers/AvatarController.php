<?php
class AvatarController extends ApplicationController
{
  public function __construct()
  {
    $this->username = UserHelper::getName();
    $this->uploaddir = AVATAR_DIR;
    $this->uploadfile = $this->uploaddir . $this->username . '.jpg';
    $this->avatarfile = $this->uploaddir . $this->username . '-avatar.jpg';
    $this->minifile = $this->uploaddir . $this->username . '-mini.jpg';
    $this->target_width = $this->target_height = 160;
    $this->mini_width = $this->mini_height = 40;
    $this->jpeg_quality = 100;
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
    $x = fRequest::get('x', 'integer');
    $y = fRequest::get('y', 'integer');
    $w = fRequest::get('w', 'integer');
    $h = fRequest::get('h', 'integer');
    $img_w = fRequest::get('img_w', 'integer');
    $img_h = fRequest::get('img_h', 'integer');
    try {
      // throw new Exception(sprintf('x=%d,y=%d,w=%d,h=%d,img_w=%d,img_h=%d', $x, $y, $w, $h, $img_w, $img_h));
      $img_r = imagecreatefromjpeg($this->uploadfile);
      $x = $x * imagesx($img_r) / $img_w;
      $y = $y * imagesy($img_r) / $img_h;
      $w = $w * imagesx($img_r) / $img_w;
      $h = $h * imagesy($img_r) / $img_h;
      $dst_r = imageCreateTrueColor($this->target_width, $this->target_height);
      imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $this->target_width, $this->target_height, $w, $h);
      imagejpeg($dst_r, $this->avatarfile, $this->jpeg_quality);
      $dst_r = imageCreateTrueColor($this->mini_width, $this->mini_height);
      imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $this->mini_width, $this->mini_height, $w, $h);
      imagejpeg($dst_r, $this->minifile, $this->jpeg_quality);
      $this->ajaxReturn(array('result' => 'success'));
    } catch (Exception $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  /**
   * Upload an image file for avatar
   */
  public function upload()
  {
    try {
      if (self::isImage($_FILES['avatar-file']) && move_uploaded_file($_FILES['avatar-file']['tmp_name'], $this->uploadfile)) {
        fURL::redirect(SITE_BASE . '/avatar/edit');
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
