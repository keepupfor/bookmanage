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
<title>图书借阅系统</title>
<body ontouchstart>
<div class="content">
<div class="header" style="z-index:5;">
    <a href="<?php echo ($url); ?>"><div class="left_t header_back">

    </div> </a>
    <div class="middle_t site_20">个人设置</div>
    <div class="right_t">
        <span class="rigth"></span>
    </div>
</div>
    <div class="person_center_top" style="background: white">
        <form action="<?php echo U('setting');?>" method="post" name="form1" id="form1">
        <div class="weui_cells weui_cells_form">
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">姓名</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name="user_name" class="weui_input" type="text" placeholder="请输入姓名" value="<?php echo ($user_name); ?>">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">安全码</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name="user_secret" class="weui_input" type="text" placeholder="请输入密保(找回密码用)" value="<?php echo ($user_secret); ?>">
                </div>
            </div>
            <div class="weui_cell weui_cell_switch">
                <div class="weui_cell_hd weui_cell_primary">接受通知</div>
                <div class="weui_cell_ft">
                    <input class="weui_switch" type="checkbox">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">生日</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name="birthday" class="weui_input" type="date" value="<?php echo ($birthday); ?>">
                </div>
            </div>
            <div class="weui_cell weui_cell_select">
                <div class="weui_cell_hd"><label style="padding-left: 15px; " for="" class="weui_label">性别</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <select name="sex" class="weui_select" name="select1">
                        <option <?php if($sex == 0): ?>selected="selected"<?php endif; ?> value="0">保密</option>
                        <option  <?php if($sex == 1): ?>selected="selected"<?php endif; ?> value="1">男</option>
                        <option  <?php if($sex == 2): ?>selected="selected"<?php endif; ?> value="2">女</option>
                    </select>
                </div>
            </div>
            <div class="weui_btn_area">
                <a class="weui_btn weui_btn_primary" href="javascript:" id="showTooltips">保存</a>
            </div>
        </div>
        </form>
    </div>
</div>
<script>
    $("#showTooltips").click(function() {
        var code = $('input[name="user_secret"]').val();
        if (!code || !/\d{6}/.test(code)) {
            $.toptip('请输入六位密保验证码');
            return false;
        }
        $.ajax({
            type:"POST",
            url:$("#form1").attr("action"),
            data:$("#form1").serialize(),
            dataType:"json",
            beforeSend:function () {
           $.showLoading("保存中")
        },
            success:function (data) {
                $.hideLoading();
                if (data.status==1)
                $.toptip('保存成功', 'success');
            },
            error:function () {
                $.hideLoading();
                $.toptip('系统错误！');
            }
        });
    });
</script>
</body>
</html>