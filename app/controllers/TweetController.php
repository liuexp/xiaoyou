<?php
class TweetController extends ApplicationController
{
  public function index()
  {
    $this->tweets = fRecordSet::build('Tweet', array(), array('timestamp' => 'desc'), ACTIVITIES_LIMIT)->getRecords();
    TweetHelper::sort($this->tweets);
    $this->render('tweet/index');
  }
  
  public function create()
  {  
    try {
      $profileId = UserHelper::getProfileId();
      $tweet = new Tweet();
      $tweet->setProfileId($profileId);
      $tweet->setContent(trim(fRequest::get('tweet-content')));
      if (strlen($tweet->getContent()) < 1) {
        throw new fValidationException('微博长度不能少于1个字符');
      }
      if (strlen($tweet->getContent()) > 140) {
        throw new fValidationException('微博长度不能超过140个字符');
      }
      $tweet->store();
      Activity::fireNewTweet();
      fMessaging::create('success', 'create tweet', '成功发表新微博！');
    } catch (fException $e) {
      fMessaging::create('failure', 'create tweet', $e->getMessage());
    }
    if (fRequest::get('quick', 'boolean')) {
      fURL::redirect(SITE_BASE . '/tweets');
    } else {
      fURL::redirect(SITE_BASE . '/profile/' . $profileId);
    }
  }
  
  public function delete($id)
  {
    try {
      $tweet = new Tweet($id);
      if (UserHelper::getProfileId() != $tweet->getProfileId() and !UserHelper::isEditor()) {
        throw new fValidationException('not allowed');
      }
      $tweet->delete();
      $this->ajaxReturn(array('result' => 'success'));
    } catch (fException $e) {
      $this->ajaxReturn(array('result' => 'failure', 'message' => $e->getMessage()));
    }
  }
  
  public function reply($id)
  {
    try {
      $tweet = new Tweet($id);
      $comment = new TweetComment();
      $comment->setTweetId($tweet->getId());
      $comment->setProfileId(UserHelper::getProfileId());
      $comment->setContent(trim(fRequest::get('tweet-comment')));
      if (strlen($comment->getContent()) < 1) {
        throw new fValidationException('回复长度不能少于1个字符');
      }
      if (strlen($comment->getContent()) > 140) {
        throw new fValidationException('回复长度不能超过140个字符');
      }
      $comment->store();
    } catch (fException $e) {
      // TODO
    }  
    fURL::redirect(SITE_BASE . '/profile/' . $tweet->getProfileId() . '#tweet/' . $tweet->getId());
  }
}
