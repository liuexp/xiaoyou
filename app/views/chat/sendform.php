<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/redis.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/css/chat.css"/>
</head>
<body>
<div class="container">
  <form class="form-horizontal" action="<?php echo SITE_BASE; ?>/chat" method="post">
    <fieldset>
      <div class="control-group">
        <label class="control-label" for="message"></label>
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
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript">parent.frames['messages'].location.reload();</script>
</body>
</html>