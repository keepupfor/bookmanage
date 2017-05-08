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
<div class="login"></div>
<div class="login_1">
    <form name="form1" id="form1" method="post" action="<?php echo U('Public/reset');?>">
        <ul>
            <li class="login_line"><img src="http://wx.365xuet.com/Public/Weixin/images/passwords.png">
                <input name="t_password" id="t_password" type="password" class="login_input" value="" placeholder="请重新输入密码" maxlength="20" style="color:#666;"></li>
            <li class="login_line"><img src="http://wx.365xuet.com/Public/Weixin/images/passwords.png">
                <input name="t_password" id="re_password" type="password" class="login_input" value="" placeholder="确认密码" maxlength="20" style="color:#666;"></li>
            <input type="hidden" id="user_type" name="user_type" value="<?php echo ($user_type); ?>" />
            <input type="hidden" id="mobile" name="mobile" value="<?php echo ($mobile); ?>" />
        </ul>
        <button id="reset" class="login_but" type="button" name="btn_login">重置密码</button>
    </form>
</div>
</body>
<script>
    $().ready(
        $("#reset").bind("click",function(){
            var password=$("#t_password").val();
            var re_password=$("#re_password").val();
            var user_type=$("#user_type").val();
            var mobile=$("#mobile").val();
//            alert(mobile+user_type+password);
            if (password!=re_password){
                myAlert("两次密码输入不一致");
                return false;
            }else if(password.length<4||password.length>20)
            {
                myAlert("请输入规范的密码");
                return false;
            }
            $.ajax({
                url:"<?php echo U('Public/reset');?>",
                type:"POST",
                dataType:"json",
                data:{password:password,
                    user_type:user_type,
                    mobile:mobile
                },
                success:function(data){
                    switch(data){
                        case 0:
                            $.toast('修改失败',"forbidden",function () {
                                window.location.href="<?php echo U('Public/login');?>";
                            });

                            break;
                        case 1:
                            $.toast('修改成功',function () {
                                window.location.href="<?php echo U('Public/login');?>";
                            });
                            break;
                    }
                }
            });
        })
    );
</script>
</html>