<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>微信投票管理系统</title>
	<meta name="keywords" content="微信投票管理系统" />
	<meta name="description" content="微信投票管理系统" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<script>var SITEURL='';</script>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style_2_common.css?BPm" />
<link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo RES;?>/css/stylet.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STATICS;?>/simpleboot/themes/flat/theme.min.css" rel="stylesheet">

<script src="<?php echo RES;?>/js/common.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/global.js"></script>
  <link rel="stylesheet" href="<?php echo RES;?>/css/cymain.css" />
  <link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />
<script src="<?php echo STATICS;?>/upyun.js"></script>

<script src="<?php echo STATICS;?>/artDialog/jquery.artDialog.js?skin=default"></script>

<script src="<?php echo STATICS;?>/artDialog/plugins/iframeTools.js"></script>

<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />



<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>



<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>



<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>

<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#content2', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [
        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
        'anchor', 'link', 'unlink', '|', 'about'
],
afterBlur: function(){this.sync();}
});
});
</script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#content1', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
filterMode: false,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [
        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
        'anchor', 'link', 'unlink', '|', 'about'
],
afterBlur: function(){this.sync();}
});
});
</script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#content', {
resizeType : 1,
filterMode: false,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items :[
        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
        'anchor', 'link', 'unlink', '|', 'about'
],
afterBlur: function(){this.sync();}
});
});
</script>



<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#intro', {
resizeType : 1,
filterMode: false,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [
'source','undo','clearhtml','hr',
'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|', 'emoticons','fontname', 'fontsize','forecolor','hilitecolor','bold','image','link', 'unlink','baidumap','lineheight','table','anchor','preview','print','template','code','cut', 'music', 'video','map'],
afterBlur: function(){this.sync();}
});
});
</script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#qtxinxi', {
resizeType : 1,
filterMode: false,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [
'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
        'anchor', 'link', 'unlink', '|', 'about'],
afterBlur: function(){this.sync();}
});
});
</script>


<style>
.content {
 background:none; margin-left:30px; margin-top:20px; border:none; margin-bottom:30px;
}
</style>
</head>

<body>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('content');?>" />   
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/bootstrap_min.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/bootstrap_responsive_min.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/sstyle.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/todc_bootstrap_button.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/themes.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/daterangepicker.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/inside.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/vote/chosen.css?2013-9-13-2" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_ui_widget_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_methods.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_wizard_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/daterangepicker.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/moment_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js?2013-9-13-2"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
 <style>
.CC_table{ border-top:2px solid #abd2f3;  width:100%; line-height:26px; font-size:14px; border-collapse:collapse;}
.CC_table th{background:#f5f5f5; border-bottom:1px dashed #ccc; padding:0 12px; color:#333;  font-weight:bold; }
.CC_table td{ border-bottom:1px dashed #ccc; padding-left:6px;height:50px;}
 </style>

<div class="box">
<div class="box-title">
                            <div class="span10">
                                <h3>修改关键字 <span class="FAQ">修改关键字回复内容</span></h3>
                            </div>
                            <div class="span2"><a class="btn btn-primary btn_submit  J_ajax_submit_btn" href="Javascript:window.history.go(-1)">返回</a></div>
                        </div>
         <div class="zdhuifu">
                  <form method="post"  action="<?php echo U('Areply/edkeyword');?>">
                   <input type="hidden" name="id" value="<?php echo ($key["id"]); ?>">
   <table class="CC_table" border="0" cellspacing="0" cellpadding="0" width="100%" >
              <tbody>
				
                  <tr><td>关键字</td><td>回复内容</td></tr>
                  	<tr>
                	<td ><input type="text" name="keyword" value="<?php echo ($key["keyword"]); ?>"></td>
                	<td><textarea class="px" style="width:600px; height:40px; margin:5px 0"  id="Hfcontent" name="content">
<?php echo ($key["content"]); ?>
</textarea></td>
                </tr>
				 <tr>
                 	<td colspan="2"  align="center"><button type="submit" name="button" class="btn btn-primary btn_submit  J_ajax_submit_btn">修改</button></td>
                 	</tr> 
				</tbody>
				</table>
 
		
      </div>
        </div>

        <div class="clr"></div>
      </div>
    </div>
  </div>
  <script>
$(document).ready( function(){ 
$('.checkall').click(function(){

$('.checkitem').each(function(){
$(this).attr('checked',$('.checkall').attr('checked'));
});
});

});
  </script>
  <!--底部-->
  	</div>
<div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>