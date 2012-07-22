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
    <link href="<?php echo SITE_BASE; ?>/images/icon.ico" rel="shortcut icon"/>
    <meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" name="viewport"/>
    <title>
      <?php echo $title . TITLE_SUFFIX; ?>
    </title>
    <link href="<?php echo SITE_BASE; ?>/css/redis.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo SITE_BASE; ?>/css/message.css" rel="stylesheet" type="text/css"/> 
    <?php if (isset($stylesheets)) foreach ($stylesheets as $stylesheet): ?>
      <link href="<?php echo SITE_BASE; ?>/css/<?php echo $stylesheet; ?>.css" rel="stylesheet" type="text/css"/>
    <?php endforeach; ?>
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
        {name:'First Level Heading', key:"1", placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '=') } },
        {name:'Second Level Heading', key:"2", placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '-') } },
        {name:'Heading 3', key:"3", openWith:'### ', placeHolder:'Your title here...' },
        {name:'Heading 4', key:"4", openWith:'#### ', placeHolder:'Your title here...' },
        {name:'Heading 5', key:"5", openWith:'##### ', placeHolder:'Your title here...' },
        {name:'Heading 6', key:"6", openWith:'###### ', placeHolder:'Your title here...' },
        {separator:'---------------' },        
        {name:'Bold', key:"B", openWith:'**', closeWith:'**'},
        {name:'Italic', key:"I", openWith:'_', closeWith:'_'},
        {separator:'---------------' },
        {name:'Bulleted List', openWith:'- ' },
        {name:'Numeric List', openWith:function(markItUp) {
            return markItUp.line+'. ';
        }},
        {separator:'---------------' },
        {name:'Picture', key:"P", replaceWith:'![[![Alternative text]!]]([![Url:!:http://]!] "[![Title]!]")'},
        {name:'Link', key:"L", openWith:'[', closeWith:']([![Url:!:http://]!] "[![Title]!]")', placeHolder:'Your text to link here...' },
        {separator:'---------------'},    
        {name:'Quotes', openWith:'> '},
        {name:'Code Block / Code', openWith:'(!(\t|!|`)!)', closeWith:'(!(`)!)'},
        {separator:'---------------'},
        {name:'Preview', call:'preview', className:"preview"}
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
    <header>
      <div class="container">
        <span class="userinfo">
          <?php if (fAuthorization::checkLoggedIn()): ?>
            <?php
              if (UserHelper::hasProfile()) {
                $profile_link = SITE_BASE . '/profile/' . UserHelper::getProfileId();
              } else {
                $profile_link = SITE_BASE . '/profiles/new';
              }
            ?>
            Hi, <a href="<?php echo $profile_link; ?>"><?php echo UserHelper::getDisplayName(); ?></a> |
	<?php if (UserHelper::isEditor()): ?>
            <a href="<?php echo SITE_BASE; ?>/manage">管理</a> |
          <?php endif; ?>
	    <a href="<?php echo SITE_BASE; ?>/inbox">短信息
<?php $c=UserHelper::hasNewMail(); if ($c>0): ?>
(<?php echo $c; ?>)
<?php endif; ?>
</a> |

          <a href="<?php echo SITE_BASE; ?>/tweets">微博</a> |
          <a href="<?php echo SITE_BASE; ?>/search">找人</a> |
            <a href="<?php echo SITE_BASE; ?>/login/change-password.php">修改密码</a> |
            <a href="<?php echo SITE_BASE; ?>/login/logout.php?back=<?php echo SITE_BASE; ?>">登出</a> |
          <?php else: ?>
            <a href="<?php echo SITE_BASE; ?>/register">注册</a> |
            <a href="<?php echo SITE_BASE; ?>/login/">登录</a> |
          <?php endif; ?>
            <a href="<?php echo SITE_BASE; ?>/help">帮助</a>
        </span>
        <a href="<?php echo SITE_BASE; ?>/">
          <img src="<?php echo SITE_BASE; ?>/images/KoGuan_logo.png" style="width: 110px;"/>
        </a>
        <nav>
          <a href="<?php echo SITE_BASE; ?>/articles">新闻</a>
          <a href="<?php echo SITE_BASE; ?>/posts">讲座</a>
          <a href="<?php echo SITE_BASE; ?>/cultures">人才培养</a>
          <a href="<?php echo SITE_BASE; ?>/infrastructures">法学院建设</a>
          <a href="<?php echo SITE_BASE; ?>/halloffames">校友风采</a>
        </nav>
      </div>
    </header>
    <div class="text columns home <?php echo isset($no_sidebar) ? 'nosidebar' : 'sidebar'; ?>">
<?php $msg=UserHelper::getMessage();if(!empty($msg)&&(!isset($isNewProfile))): ?>
            <div class="alert alert-success fade in">
              <a class="close" data-dismiss="alert">&times;</a>
<?php echo $msg; ?>
            </div>
<?php endif; ?>


