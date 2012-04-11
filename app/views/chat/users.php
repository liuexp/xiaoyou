<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/redis.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/chat.css"/>
  <script type="text/javascript">window.users_url = '<?php echo SITE_BASE; ?>/chat/ajax-users';</script>
</head>
<body>
<div class="container"></div>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/hide-broken-images.js"></script>
<script type="text/javascript">
$(function(){
  $('.container').load(window.users_url);
  setInterval(function(){
    $('.container').load(window.users_url);
  }, <?php echo 1000 * 2 * $this->pollInterval; ?>);
  $.ajaxSetup({ cache: false });
})
</script>
</body>
</html>