<?php
//The simplest way to require/include wp-load.php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require( $parse_uri[0] . 'wp-load.php' );

if (isset($_POST['email'])&&$_POST['email']!=''){
	send_mail_login_token($_POST['email']);
}elseif (isset($_GET['hash'])&&$_GET['hash']!=''){
	mail_login_access_check($_GET['hash']);
}

?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
a,abbr,acronym,address,applet,big,blockquote,body,caption,cite,code,dd,del,dfn,div,dl,dt,em,fieldset,font,form,h1,h2,h3,h4,h5,h6,html,iframe,ins,kbd,label,legend,li,object,ol,p,pre,q,s,samp,small,span,strike,strong,sub,sup,table,tbody,td,tfoot,th,thead,tr,tt,ul,var{margin:0;padding:0;outline:0;border:0;vertical-align:baseline;font-weight:inherit;font-style:inherit;font-size:100%;font-family:inherit;}html{box-sizing:border-box;font-size:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;}button,input,textarea{outline:0;font-family:"Hiragino Sans GB","Microsoft YaHei",STHeiti,"WenQuanYi Micro Hei",Helvetica,Arial,sans-serif;-webkit-appearance:none;-webkit-tap-highlight-color:transparent;}button:focus,input:focus,textarea:focus{outline:0;}body{color:rgba(0,0,0,.8);font-family:"Hiragino Sans GB","Microsoft YaHei",STHeiti,"WenQuanYi Micro Hei",Helvetica,Arial,sans-serif;line-height:1.8;text-rendering:optimizeLegibility;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;-moz-font-feature-settings:"liga" on;}article,aside,details,figcaption,figure,footer,header,main,nav,section{display:block;}ol,ul{list-style:none;}table{border-collapse:collapse;border-spacing:0;}caption,td,th{text-align:left;font-weight:400;}a:active,a:hover{outline:0;}pre{position:relative;margin:40px 0;padding:0 20px;background-color:#f8f8f8;white-space:pre-wrap;word-wrap:break-word;font:14px/22px 'courier new';}pre:after,pre:before{display:block;padding-top:10px;padding-bottom:10px;color:#2f76bb;}pre:before{content:"-- CODE --";}pre:after{content:"-- EOF --";text-align:right;}code{padding:2px;border-radius:3px;background-color:#eee;white-space:pre-wrap;word-wrap:break-word;letter-spacing:0;font:14px/26px 'courier new';word-break:break-word;}pre code{padding:0;border-radius:0;background-color:#fff;}img{height:auto;max-width:100%;}button::-moz-focus-inner{padding:0;border:0;}a{color:inherit;text-decoration:none;}input[disabled]{background-color:rgba(0,0,0,.05);color:rgba(0,0,0,.8);cursor:default;}@keyframes shift-rightwards{0%{-webkit-transform:translateX(-100%);transform:translateX(-100%);}40%{-webkit-transform:translateX(0);transform:translateX(0);}60%{-webkit-transform:translateX(0);transform:translateX(0);}100%{-webkit-transform:translateX(100%);transform:translateX(100%);}}@-webkit-keyframes shift-rightwards{0%{-webkit-transform:translateX(-100%);}40%{-webkit-transform:translateX(0);}60%{-webkit-transform:translateX(0);}100%{-webkit-transform:translateX(100%);}}@keyframes appearfromup{0%{-webkit-transform:translateY(-200px);transform:translateY(-200px);}100%{-webkit-transform:translateY(0);transform:translateY(0);}}@-webkit-keyframes appearfromup{0%{-webkit-transform:translateY(-200px);}100%{-webkit-transform:translateY(0);}}@keyframes topShow{0%{-webkit-transform:translateX(-10px);transform:translateX(-10px);}30%{-webkit-transform:translateX(10px);transform:translateX(10px);}60%{-webkit-transform:translateX(-20px);transform:translateX(-20px);}60%{-webkit-transform:translateX(20px);transform:translateX(20px);}100%{-webkit-transform:translateY(0);transform:translateY(0);}}@-webkit-keyframes topShow{0%{-webkit-transform:translateX(-10px);}30%{-webkit-transform:translateX(10px);}60%{-webkit-transform:translateX(-20px);}60%{-webkit-transform:translateX(20px);}100%{-webkit-transform:translateY(0);}}@-webkit-keyframes heartbeat{0%{-webkit-transform:scale(.9);}9%{-webkit-transform:scale(1.2);}18%{-webkit-transform:scale(.9);}25%{-webkit-transform:scale(1);}100%{-webkit-transform:scale(1);}}@keyframes heartbeat{0%{-webkit-transform:scale(.9);transform:scale(.9);}9%{-webkit-transform:scale(1.2);transform:scale(1.2);}18%{-webkit-transform:scale(.9);transform:scale(.9);}25%{-webkit-transform:scale(1);transform:scale(1);}100%{-webkit-transform:scale(1);transform:scale(1);}}.surface-overlay{position:fixed;top:0;right:0;bottom:0;left:0;z-index:500;background-color:rgba(255,255,255,.98);}.v-textAlignCenter{text-align:center;},.overlay-dialog--signin{text-align:center;}.overlay-dialog--animate{-webkit-transform-origin:bottom center;transform-origin:bottom center;-ms-transform-origin:bottom center;-webkit-animation:scale-fade 300ms forwards cubic-bezier(.8,.02,.45,.91);animation:scale-fade 300ms forwards cubic-bezier(.8,.02,.45,.91);}.overlay-dialog{display:inline-block;overflow:hidden;padding:100px 80px;width:90%;max-width:580px;vertical-align:middle;}.overlay-title{margin-bottom:20px;font-weight:700;font-size:22px;line-height:1.4;}.overlay-content{margin-bottom:30px;color:rgba(0,0,0,.6);line-height:1.4;}.u-xs-bottom20{padding-bottom:20px;}.u-xs-top10{padding-top:10px;}.overlay--input{-webkit-box-sizing:border-box;box-sizing:border-box;padding:0 15px;width:255px;height:35px;outline:medium none;border:1px solid rgba(0,0,0,.15);border-radius:4px;background:#fff none repeat scroll 0 0;font-weight:400;font-style:normal;font-size:14px;}#cancel-comment-reply-link,#submit{display:inline-block;padding:2px 10px;border:2px #2f76bb solid;border-radius:3px;background-color:#fff;color:#2f76bb;font-size:12px;}.v-cursorPointer{cursor:pointer;}.js-action[data-action=imageZoomIn]{cursor:-webkit-zoom-in;cursor:zoom-in;}
</style>
</head>
<body>
<form method="POST">
<div class="surface-overlay v-textAlignCenter">
	<div class="overlay-dialog overlay-dialog--signin overlay-dialog--animate">
		<h3 class="overlay-title"><?php echo get_option('blogname'); ?></h3>
		<div class="overlay-content">
			<div class="u-xs-top10 u-xs-bottom20">
				输入您的邮箱以便验证身份登录
			</div>
			<div class="overlay--inputs">
				<input type="email" name="email" class="overlay--input" placeholder="yourname@example.com" value="">
			</div>
		</div>
		<div class="overlay-actions">
			<input type="submit" id="submit" class="inputSubmit js-action v-cursorPointer" value="申请授权">
		</div>
	</div>
</div>
</form>
</body>
</html>
