  </div>
			<div id="Footer">
				<p></p>
				<p>
					<a href="<?php echo HOST_URL . SITE_BASE; ?>/">首页</a>
					&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				        <a href="<?php echo SITE_BASE; ?>/articles">新闻</a>
					&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				        <a href="<?php echo SITE_BASE; ?>/posts">讲座</a>
					&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				        <a href="<?php echo SITE_BASE; ?>/cultures">人才培养</a>
					&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				        <a href="<?php echo SITE_BASE; ?>/infrastructures">法学院建设</a>
					&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				        <a href="<?php echo SITE_BASE; ?>/halloffames">校友风采</a>
				</p>
				<p>
				版权所有 上海交通大学凯原法学院 © 2012 All Rights Reserved
				</p>
				<p></p>
				<p>
				any questions,please click <a href="http://xiaoyou.acm-project.org/profile/1">here</a>
				</p>
			</div>
  <script type="text/javascript">window.siteBase = '<?php echo SITE_BASE; ?>';</script>
  <script type="text/javascript">window.digitsSuffix = '.png';</script>
  <!--[if lt IE 10]>
  <script type="text/javascript">window.digitsSuffix = '.gif';</script>
  <![endif]-->
<?php if (isset($javascripts)) foreach ($javascripts as $javascript): ?>
  <script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/<?php echo $javascript; ?>.js"></script>
<?php endforeach; ?>
</body>
</html>
