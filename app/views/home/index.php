<?php
$title = '首页';
$no_sidebar = true;
$no_columns = true;
$stylesheets = array('home','skin_def');
include(__DIR__ . '/../layout/header.php');
?>
<div id="Mainer">
<div class="row1"><div style="width:900px;" class="col2"><div id="module1101"><table width="900" height="270" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tbody><tr><td width="650"><script src="<?php echo SITE_BASE; ?>/js/swfobject_source.js" type="text/javascript"></script><div id="dplayer2" style="padding-right: 0px; padding-left: 0px; background: #ffffff;padding-bottom: 0px; margin: 0px auto; width: 650px; padding-top: 0px; height: 268px"><embed pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" src="images/flash/switchphoto.swf" width="650" height="268" style="undefined" id="mymovie" name="mymovie" quality="high" allowfullscreen="true" allowscriptaccess="always" wmode="Transparent" flashvars="pw=650&amp;ph=268&amp;sizes=14&amp;umcolor=16777215&amp;btnbg=9180694&amp;txtcolor=16777215&amp;txtoutcolor=0&amp;urls=#|#|#|#&amp;Times=4000&amp;titles=百年交大|法学院徐汇新楼落成在即|雄厚师资|勤奋学子&amp;imgs=images/KoGuanShow/13764029.jpg|images/KoGuanShow/13763827.jpg|images/KoGuanShow/13766703.jpg|images/KoGuanShow/13766940.jpg&amp;realfull=1&amp;moz=1&quot;/"></div><script language="javascript" type="text/javascript">var titles = '百年交大|法学院徐汇新楼落成在即|雄厚师资|勤奋学子';var imgs = 'images/KoGuanShow/13764029.jpg|images/KoGuanShow/13763827.jpg|images/KoGuanShow/13766703.jpg|images/KoGuanShow/13766940.jpg';var urls = '#|#|#|#';var pw = 650;var ph = 268;var sizes = 14;var Times = 4000;var umcolor = 0xFFFFFF;var btnbg = 0x8c1616;var txtcolor = 0xFFFFFF;var txtoutcolor = 0x000000;var flash = new SWFObject('images/flash/switchphoto.swf', 'mymovie', pw, ph, '7', '');flash.addParam('allowFullScreen', 'true');flash.addParam('allowScriptAccess', 'always');flash.addParam('quality', 'high');flash.addParam('wmode', 'Transparent');flash.addVariable('pw', pw);flash.addVariable('ph', ph);flash.addVariable('sizes', sizes);flash.addVariable('umcolor', umcolor);flash.addVariable('btnbg', btnbg);flash.addVariable('txtcolor', txtcolor);flash.addVariable('txtoutcolor', txtoutcolor);flash.addVariable('urls', urls);flash.addVariable('Times', Times);flash.addVariable('titles', titles);flash.addVariable('imgs', imgs);flash.write('dplayer2');</script></td><td width="266"><a href="/WebSite/Article.aspx?lm=0106" target="_blank"><img src="images/KoGuanShow/why.gif" width="246" height="268" border="0"></a></td></tr></tbody></table></div></div><div class="clear"></div></div>
  <div class="row1">
	<div style="width:300px;" class="col2">
	<div class="articletop2">
		<div class="head">
		<span class="box_r">
			<a href="<?php echo SITE_BASE; ?>/articles" target="_self">更多内容</a>
		</span>
		<span class="title">新闻</span>
		</div>
		<div class="body">
      <ul class="newlist">
        <?php $need_intro = false; ?>
        <?php foreach ($this->articles as $article): ?>
          <?php if ($article->getPriority() < 100 && $need_intro): ?>
            <?php $need_intro = false; ?>
          <?php endif; ?>
          <li data-article-id="<?php echo $article->getId(); ?>">
		  <span class="box_r" ><?php echo $article->getCreatedAt(); ?></span>
            <a href="<?php echo SITE_BASE; ?>/article/<?php echo $article->getId(); ?>"><?php echo $article->getShortTitle(); ?></a>
            <?php if ($article->isRecent()): ?><img src="<?php echo SITE_BASE; ?>/images/new.gif"/><?php endif; ?>
          </li>
        <?php endforeach; ?>
        <!-- <li class="more"><a href="<?php echo SITE_BASE; ?>/articles">更多⋯⋯</a></li> -->
      </ul>
		</div>
	</div>
	</div>
	<div style="width:300px;" class="col2">
	<div class="articletop2">
		<div class="head">
		<span class="box_r">
			<a href="<?php echo SITE_BASE; ?>/posts" target="_self">更多内容</a>
		</span>
		<span class="title">讲座信息</span>
		</div>
		<div class="body">
      <ul class="newlist">
        <?php $first_post = true; ?>
        <?php foreach ($this->posts as $article): ?>
          <li data-article-id="<?php echo $article->getId(); ?>">
		  <span class="box_r" ><?php echo $article->getCreatedAt(); ?></span>
            <a href="<?php echo SITE_BASE; ?>/article/<?php echo $article->getId(); ?>"><?php echo $article->getShortTitle(); ?></a>
            <?php if ($first_post): ?>
              <!-- <img src="<?php echo SITE_BASE; ?>/images/new.gif"/> -->
              <?php $first_post = false; ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
        <!-- <li class="more"><a href="<?php echo SITE_BASE; ?>/posts">更多⋯⋯</a></li> -->
      </ul>
		</div>
	</div>
	</div>
	<div style="width:300px;" class="col2">
	<div class="articletop2">
		<div class="head">
		<span class="title">最新动态</span>
		</div>
		<div class="body">
      <ul class="newlist">
        <?php foreach ($this->activities as $activity): ?>
          <li>
            <?php include(__DIR__ . '/_activity.php'); ?>
          </li>
        <?php endforeach; ?>
      </ul>
		</div>
	</div>
	</div>

  </div>
	</div>
	</div>
<?php
$javascripts = array('jquery-1.4.2.min', 'jquery.countdown', 'home/index');
include(__DIR__ . '/../layout/footer.php');
