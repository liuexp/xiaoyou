<meta http-equiv="refresh" content="<?php echo $this->pollInterval; ?>"/>
<body onload="window.location='#bottom'">
<pre><?php print_r($this->messages); ?></pre>
<form action="<?php echo SITE_BASE; ?>/chat" method="post">
  <textarea name="message"></textarea>
  <button type="submit">发送</button>
</form>
<a id="bottom" name="bottom">&nbsp;</a>
</body>