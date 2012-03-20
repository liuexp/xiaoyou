  </div>
  <footer>
    <p>
      This website is <a href="https://github.com/oipn4e2/xiaoyou">open source software</a> developed by <a href="http://acm.sjtu.edu.cn/~xjia">Xiao Jia</a>.
    </p>
    <p>
      The ACM class logo was designed by <a href="#">Weinan Zhang</a>. See more <a href="#">credits</a>.
    </p>
    <p>
      Copyright &copy; 2012 <a href="http://acm.sjtu.edu.cn/">ACM class</a>. All rights reserved.
    </p>
    <div class="sponsor">
      <a href="http://www.sjtu.edu.cn/">
        <img alt="上海交通大学" width="121px" height="39px" src="<?php echo SITE_BASE; ?>/images/sjtu.png"/>
      </a>
    </div>
  </footer>
  <script type="text/javascript">window.siteBase = '<?php echo SITE_BASE; ?>';</script>
<?php if (isset($javascripts)) foreach ($javascripts as $javascript): ?>
  <script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/<?php echo $javascript; ?>.js"></script>
<?php endforeach; ?>
</body>
</html>
