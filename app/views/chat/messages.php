<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/redis.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/chat.css"/>
  <script type="text/javascript">window.messages_url = '<?php echo SITE_BASE; ?>/chat/ajax-messages';</script>
</head>
<body>
<div id="message-container" class="container"></div>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/hide-broken-images.js"></script>
<script type="text/javascript">
$(function(){
  $('#message-container').load(window.messages_url);
  setInterval(function(){
    $('#message-container').load(window.messages_url);
  }, <?php echo 1000 * $this->pollInterval; ?>);
  $.ajaxSetup({ cache: false });
})
</script>
</body>
</html>