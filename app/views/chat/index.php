<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>在线聊天</title>
</head>
<frameset cols="30%,70%">
  <frame id="users" name="users" src="<?php echo SITE_BASE; ?>/chat/users"></frame>
  <frameset rows="10%,90%">
    <frame id="sendform" name="sendform" src="<?php echo SITE_BASE; ?>/chat/sendform"></frame>
    <frame id="messages" name="messages" src="<?php echo SITE_BASE; ?>/chat/messages"></frame>
  </frameset>
</frameset>
</html>