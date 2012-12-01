<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <!--[if lt IE 7]>
    <script type="text/javascript">var IE7_PNG_SUFFIX = ".png";</script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/IE9.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="http://law.sjtu.edu.cn/Images/icon.ico" type="image/x-icon"/>
    <meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" name="viewport"/>
    <title>
      <?php echo $title . TITLE_SUFFIX; ?>
    </title>
    <link href="<?php echo SITE_BASE; ?>/css/redis.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo SITE_BASE; ?>/css/message.css" rel="stylesheet" type="text/css"/> 
        <?php if (isset($stylesheets)) foreach ($stylesheets as $stylesheet): ?>
      <link href="<?php echo SITE_BASE; ?>/css/<?php echo $stylesheet; ?>.css" rel="stylesheet" type="text/css"/>
    <?php endforeach; ?>
    <link href="<?php echo SITE_BASE; ?>/css/skin_def.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo SITE_BASE; ?>/css/header.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo SITE_BASE; ?>/css/footer.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/jquery.blockui.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/bootstrap.min.js"></script>
    <?php if (isset($getMarkdown)) : ?>
<!-- markItUp! -->
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/markitup/jquery.markitup.js"></script>
<!-- markItUp! toolbar settings -->
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/markitup/sets/markdown/set.js"></script>
<!-- markItUp! skin -->
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/markitup/skins/markitup/style.css" />
<!--  markItUp! toolbar skin -->
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE; ?>/markitup/sets/markdown/style.css" />
    <?php endif; ?>
  </head>
  <body>
    <?php if (isset($getMarkdown)) : ?>
<script type="text/javascript">
<!--
myMarkdownSettings = {
    nameSpace:          'markdown', // Useful to prevent multi-instances CSS conflict
	    previewParserPath:  '<?php echo SITE_BASE; ?>/article/preview',
    onShiftEnter:       {keepDefault:false, openWith:'\n\n'},
    markupSet: [
        {name:'一级标题', key:"1", placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '=') } },
        {name:'二级标题', key:"2", placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '-') } },
        {name:'Heading 3', key:"3", openWith:'### ', placeHolder:'Your title here...' },
        {name:'Heading 4', key:"4", openWith:'#### ', placeHolder:'Your title here...' },
        {name:'Heading 5', key:"5", openWith:'##### ', placeHolder:'Your title here...' },
        {name:'Heading 6', key:"6", openWith:'###### ', placeHolder:'Your title here...' },
        {separator:'---------------' },        
        {name:'加粗', key:"B", openWith:'**', closeWith:'**'},
        {name:'斜体', key:"I", openWith:'_', closeWith:'_'},
        {separator:'---------------' },
        {name:'Bulleted List', openWith:'- ' },
        {name:'Numeric List', openWith:function(markItUp) {
            return markItUp.line+'. ';
        }},
        {separator:'---------------' },
        {name:'图片', key:"P", replaceWith:'![[![显示文字]!]]([![图片地址:!:http://]!] "[![图片标题]!]")'},
        {name:'链接', key:"L", openWith:'[', closeWith:']([![链接地址:!:http://]!] "[![链接标签]!]")', placeHolder:'Your text to link here...' },
        {separator:'---------------'},    
        {name:'引用', openWith:'> '},
        {name:'代码', openWith:'(!(\t|!|`)!)', closeWith:'(!(`)!)'},
        {separator:'---------------'},
        {name:'预览', call:'preview', className:"preview"}
    ]
}
$(document).ready(function()	{
	// Add markItUp! to your textarea in one line
	// $('textarea').markItUp( { Settings }, { OptionalExtraSettings } );
	$('#markdown').markItUp(myMarkdownSettings).css('height', function() {
  /* Since line-height is set in the markItUp-css, fetch that value and
  split it into value and unit.  */
  var h = jQuery(this).css('line-height').match(/(\d+)(.*)/)
  /* Multiply line-height-value with nr-of-rows and add the unit.  */
  return (h[1]*jQuery(this).attr('rows'))+h[2]
	});
});
-->
</script>

    <?php endif; ?>

			<div id="Header">		
				<div class="link">
					<div style="height:30px;">
					<a href="<?php echo HOST_URL . SITE_BASE; ?>/" class="icon_home" title="首页"></a>
					<a href="http://law.sjtu.edu.cn/En/" class="icon_eng" title="English"></a>
					<a href="http://law.sjtu.edu.cn/Article0305.aspx" target="_blank" class="icon_job" title="招聘"></a>
					<a href="mailto:zhanwangcn@sjtu.edu.cn" class="icon_link" title="联系"></a>
					<a href="http://law.sjtu.edu.cn/Rss/" target="_blank" class="icon_rss"></a>
					<a href="http://weibo.com/2415072065" target="_blank" class="icon_sina" title="新浪微博"></a>
					</div>
					<div>
					<a href="<?php echo SITE_BASE; ?>/register" title="注册">注册</a>
					<a href="<?php echo SITE_BASE; ?>/login/" title="登录">登录</a>
					<a class="last_anchor" href="<?php echo SITE_BASE; ?>/help" title="帮助">帮助</a>
					</div>
				</div>
				<div class="body">
					<div class="logo">
						<div class="logo1" onclick="window.open(&#39;http://www.sjtu.edu.cn/&#39;);" title="上海交通大学"></div>
						<div class="logo2" onclick="window.open(&#39;/&#39;);" title="凯源法学院"></div>
					</div>
					<!--<div class="search">
						站内搜索 
						<input type="text" size="10" id="TxtKeyword" class="sel">
						<input type="button" id="BtnSearch" value=" " class="btn" style="height:21px;width:30px;position:relative; left:-5px;" onclick="doSearch();">
					</div>
				</div>-->
				<div id="Header_Menu">
					<ul>
						<li>
						<a href="<?php echo SITE_BASE; ?>/articles">新闻</a>
						</li>
						<ul>
						</ul>
						<li>
						<a href="<?php echo SITE_BASE; ?>/posts">讲座</a>
						</li>
						<ul>
						</ul>
						<li>
						<a href="<?php echo SITE_BASE; ?>/cultures">人才培养</a>
						</li>
						<ul>
						</ul>
						<li>
						<a href="<?php echo SITE_BASE; ?>/infrastructures">法学院建设</a>
						</li>
						<ul>
						</ul>
						<li>
						<a href="<?php echo SITE_BASE; ?>/halloffames">校友风采</a>
						</li>
						<ul>
						</ul>
					</ul>	
				</div>
			</div>		
    <div class="text columns home <?php echo isset($no_sidebar) ? 'nosidebar' : 'sidebar'; ?>">
<?php $msg=UserHelper::getMessage();if(!empty($msg)&&(!isset($isNewProfile))): ?>
            <div class="alert alert-success fade in">
              <a class="close" data-dismiss="alert">&times;</a>
<?php echo $msg; ?>
            </div>
<?php endif; ?>


