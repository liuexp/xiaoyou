  </div>
  <footer>
    <p>
      This website is <a href="https://github.com/oipn4e2/xiaoyou">open source software</a> developed by <a href="http://xiaoyou.acm-project.org/profile/1">Xiao Jia</a>.
    </p>
      <p>
版权所有 上海交通大学凯原法学院 © 2012 All Rights Reserved
    </p>
    <div class="sponsor">
      <a href="http://www.sjtu.edu.cn/">
        <img width="121px" height="39px" src="<?php echo SITE_BASE; ?>/images/sjtu.png"/>
      </a>
    </div>
  </footer>
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
