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
    <div class="middle_t site_20">密码设置</div>
    <div class="right_t">
        <span class="rigth"></span>
    </div>
</div>
    <div class="person_center_top" style="background: white">
        <form action="<?php echo U('change_pwd');?>" method="post" name="form1" id="form1">
        <div class="weui_cells weui_cells_form">
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">原密码</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name="user_pass" class="weui_input" type="text" placeholder="请输入原密码" value="">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">新密码</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name="user_new_pass" class="weui_input" type="text" placeholder="请输入新密码" value="">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">确认密码</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name="user_sure_pass" class="weui_input" type="text" placeholder="请确认新密码" value="">
                </div>
            </div>
            <div class="weui_btn_area">
                <a class="weui_btn weui_btn_primary" href="javascript:" id="showTooltips">确定修改</a>
            </div>
        </div>
        </form>
    </div>
</div>
<script>
    $("#showTooltips").click(function() {
        var user_pass = $('input[name="user_pass"]').val();
        var user_new_pass = $('input[name="user_new_pass"]').val();
        var user_sure_pass = $('input[name="user_sure_pass"]').val();
        if (user_pass=='') {
            $.toptip('原密码不能为空');
            return false;
        }
        if (user_new_pass=='') {
            $.toptip('新密码不能为空');
            return false;
        } if (user_sure_pass=='') {
            $.toptip('确认密码不能为空');
            return false;
        }

        if (user_pass==user_new_pass) {
            $.toptip('新密码不能与原密码一致');
            return false;
        }
        if(user_new_pass!=user_sure_pass){
            $.toptip('新密码两次输入不一致');
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
                {
                    $.toast('保存成功', 'success',function () {
                     window.location.href = "<?php echo U('Mycenter/index');?>"
                });
                }
                if(data.status==-1){
                    $.toptip('原密码错误！');
                }
                if(data.status==0){
                    $.toptip('保存失败！');
                }
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