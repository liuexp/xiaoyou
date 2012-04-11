<script type="text/javascript">
function prepare_refresh() {
  setTimeout("window.location='#bottom'", <?php echo 1000 * $this->pollInterval; ?>);
}
</script>
<body onload="prepare_refresh()">
<pre><?php print_r($this->messages); ?></pre>
<a id="bottom" name="bottom">&nbsp;</a>
</body>