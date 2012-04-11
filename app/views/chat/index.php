<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>在线聊天</title>
  <script type="text/javascript">window.messages_url = '<?php echo SITE_BASE; ?>/chat/ajax-messages';</script>
</head>
<frameset cols="200px,*">
  <frame id="users" name="users" src="<?php echo SITE_BASE; ?>/chat/users"></frame>
  <frameset rows="50px,*">
    <frame id="sendform" name="sendform" src="<?php echo SITE_BASE; ?>/chat/sendform"></frame>
    <frame id="messages" name="messages" src="<?php echo SITE_BASE; ?>/chat/messages"></frame>
  </frameset>
</frameset>
</html>