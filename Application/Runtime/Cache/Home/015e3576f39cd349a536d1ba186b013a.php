<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
    <meta name="format-detection" content="telephone=no" /><!--禁止识别为手机号-->
    <!--   <link rel="shortcut icon" href="favicon.ico"  />
      <link rel="Bookmark" href="favicon.ico"  />-->
    <!--jQuery weui-->
    <link rel="stylesheet" href="http://wx.365xuet.com/Public/Weui/css/weui.min.css">
    <link rel="stylesheet" href="http://wx.365xuet.com/Public/Weui/css/jquery-weui.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/style.css">
    <!-- Standard iPhone -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png" />
    <!-- Retina iPhone -->
    <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-120x120.png" />
    <!-- Standard iPad -->
    <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-iphone-76x76.png" />
    <!-- Retina iPad -->
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-152x152.png" />

    <script type="application/javascript" src="/Public/js/jquery.min..js"></script>
    <script type="application/javascript" src="/Public/js/jquery-weui.min.js"></script>
    <script type="application/javascript" src="/Public/js/jquery.cookie.js"></script>
    <script type="application/javascript" src="/Public/js/jquery.form.js"></script>
    <script type="application/javascript" src="/Public/js/commjslib.js"></script>
    <script type="application/javascript" src="/Public/js/layer.m/layer.m.js"></script>
    <script type="application/javascript" src="/Public/js/h5.js"></script>
    <script type="application/javascript" src="/Public/js/imagevisible.js"></script>
    <script type="application/javascript" src="/Public/js/swiper.js"></script>
    <script>
        function go_detail(isbn) {
            window.location.href=" <?php echo U('home/Bookadmin/index/isbn/"+isbn+"');?>"
        }
    </script>
</head>
<body>
<div class="header" style="text-align: center;z-index:5;">
	用户注册
</div>
<div style="width: 100%;text-align: right;">已有帐号？<a style="margin-right:4%;" href="<?php echo U('login');?>">立即登陆</a></div>

<div class="login_1 content">
	<form name="form1" id="form1" method="post">
		<ul>
			<!--地区-->
			<li class="login_line"><img src="http://wx.365xuet.com/Public/Weixin/images/member.png">
				<input name="t_mobile" id="t_mobile" type="tel" class="weui_input" value="" placeholder="手机号码" maxlength="11" style="padding-left: 2vw;width:auto;color:#666;" /></li>

			<li class="login_line"><img src="http://wx.365xuet.com/Public/Weixin/images/passwords.png">
				<input name="t_password" id="t_password" type="password" class="weui_input" value="" placeholder="密码" maxlength="20" style="padding-left: 2vw;width:auto;color:#666;"></li>
			<li class="login_line"><img src="http://wx.365xuet.com/Public/Weixin/images/passwords.png">
				<input name="t_password" id="re_password" type="password" class="weui_input" value="" placeholder="确认密码" maxlength="20" style="padding-left: 2vw;width:auto;color:#666;"></li>
		</ul>
		<div style="width: 100%;text-align: center;margin-top: 10px">
		<label class="radio-inline">
			<input type="radio" name="identify" id="inlineRadio1" value="1" checked> 会员
		</label>
		<!--<label class="radio-inline">-->
			<!--<input type="radio" name="identify" id="inlineRadio2" value="2"> 管理员-->
		<!--</label>-->
			</div>
		<button class="login_but" type="button" name="btn_login" onclick="register();">注册</button>
		<div style="width: 60%;float:right;text-align: right;margin-right: 5px">已有账号？<a style="color: #337ab7" href="<?php echo U('login');?>">立即登录</a></div>
	</form>
</div>
</body>
</html>
<script>
	function register()
	{
		var mobile=$("#t_mobile").val();
		var password=$("#t_password").val();
		var re_password=$("#re_password").val();
		if(!isMobile(mobile))
		{
			myAlert("请输入正确的手机号码");
			return false;
		}
		else if (password!=re_password){
			myAlert("两次密码输入不一致");
			return false;
		}
		$.showLoading("注册中..");
		$.post($("#form1").attr("action"),$("#form1").serialize(),function (data) {
			if (data.status==1){
				$.hideLoading();
				$.toast('注册成功!',function () {
					window.location.href="<?php echo U('home/index/index');?>";
				} );
			}
			else if (data.status==0){
				$.hideLoading();
				$.toast(data.info,"forbidden",function () {
					window.location.href="<?php echo U('home/index/index');?>";
				});
			}else{
				setTimeout(function () {
					$.hideLoading();
				},3000);
			}

		});
	}
</script>