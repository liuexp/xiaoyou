<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/chat.css"/>
  <script type="text/javascript">window.messages_url = '<?php echo SITE_BASE; ?>/chat/ajax-messages';</script>
</head>
<body>
<div class="container">
  <form class="form-horizontal" action="<?php echo SITE_BASE; ?>/chat" method="post" onsubmit="$.blockUI();">
    <fieldset>
      <div class="control-group">
        <div class="controls">
          <div class="input-append">
            <input class="span4" id="message" type="text" name="message" size="140" maxlength="140"/>
            <button type="submit" class="btn btn-primary">发送</button>
          </div>
        </div>
      </div>
    </fieldset>
  </form>
</div><!-- /.container -->
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/jquery.blockui.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript">
$('#message-container', parent.frames['messages']).load(window.messages_url);
document.getElementById('message').focus();
</script>
</body>
</html>