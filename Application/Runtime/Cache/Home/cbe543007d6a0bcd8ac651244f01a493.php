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
<div class="login" style="height: 30px"></div>
<div style="width: 100%;text-align: right;margin-right: 5px">已有帐号？<a href="<?php echo U('login');?>">立即登陆</a></div>

<div class="forget_1 login_1">
    <form name="form1" id="form1" method="post">
        <ul>
            <li class="login_line"><img src="http://wx.365xuet.com/Public/Weixin/images/member.png">
                <input id="mobile" name="mobile"  style=" width: auto;   padding-left: 2vw;" type="tel" class="weui_input" value="" placeholder="手机号码" maxlength="11" style="color:#666;"></li>

            <li class="login_line" ><img src="http://wx.365xuet.com/Public/Weixin/images/comment.png">
               <input class="weui_input"  style="width: auto;padding-left: 2vw" name="user_secret" placeholder="请输入安全码">
            <li>安全码初始值为：123456</li>
        </ul>
        <label class="radio-inline">
            <input type="radio" name="user_type" id="inlineRadio1" value="1" checked> 会员
        </label>
        <label class="radio-inline">
            <input type="radio" name="user_type" id="inlineRadio2" value="2"> 管理员
        </label>
        <button class="login_but" type="button" name="btn_login" onclick="forget();">找回密码</button>
    </form>
</div>
</body>
<script>
    function forget(){
        var phone_preg1=/1[3-8]+\d{9}/;
        var phone_preg2=/^[0-9]{11}?$/;
        var phone=$("#mobile").val();
        if(!phone || !phone_preg1.test(phone) ||!phone_preg2.test(phone)){
            myAlert('手机号码格式不正确');
            return;
        }
        $("#form1").ajaxSubmit({
            type:"post",
            dataType:"json",
            success:function (data) {
                if (data.status==0){
                    $.toast(data.info)
                }else {
                    window.location.href="<?php echo U('reset');?>"+"?mobile="+data.mobile+""+"&user_type="+data.user_type+"";
                }
            }
        });
    }
</script>
</html>