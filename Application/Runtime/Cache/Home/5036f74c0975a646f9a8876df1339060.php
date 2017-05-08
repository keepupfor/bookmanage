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


<div class="header" style="z-index:5;text-align: center">
  个人中心
    </div>
</div>
<div class="person_center_top">
    <ul>
        <li><img src="http://wx.365xuet.com/Public/Weixin/images/index-mid-1.png" alt=""></li>
        <li><?php echo ($user_name); ?></li>
        <?php if($user_type == 1): ?><li>积分：<b><?php echo ($corn); ?></b></li><?php endif; ?>
    </ul>
</div>
<div class="bd">
    <div class="weui_cells weui_cells_access">

        <a class="weui_cell" href="<?php echo ('setting');?>">
            <div class="weui_cell_hd"><img src="/Public/images/personal.png" alt="" width="20"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>个人设置</p>
            </div>
            <div class="weui_cell_ft"> </div>
        </a>
        <a class="weui_cell" href="<?php echo ('change_pwd');?>">
            <div class="weui_cell_hd"><img src="/Public/images/passwordx.png" alt="" width="20"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>修改密码</p>
            </div>
            <div class="weui_cell_ft"> </div>
        </a>
    </div>
<?php if($user_type == 1): ?><div class="weui_cells_title"> </div>
    <div class="weui_cells weui_cells_access">

        <a class="weui_cell" href="<?php echo ('favorites');?>">
            <div class="weui_cell_hd"><img src="/Public/images/question.png" alt="" width="20"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的收藏</p>
            </div>
            <div class="weui_cell_ft"> </div>
        </a>
        <a class="weui_cell" href="<?php echo ('appointment');?>">
            <div class="weui_cell_hd"><img src="http://wx.365xuet.com/Public/Weixin/images/index-mid-4.png" alt="" width="20"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的预约</p>
            </div>
            <div class="weui_cell_ft"> </div>
        </a>
        <a class="weui_cell" href="<?php echo ('order');?>">
            <div class="weui_cell_hd"><img src="http://wx.365xuet.com/Public/Weixin/images/index-mid-3.png" alt="" width="20"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>借阅记录</p>
            </div>
            <div class="weui_cell_ft"> </div>
        </a>
    </div>

    <div class="weui_cells_title"></div>
    <div class="weui_cells weui_cells_access">

        <a class="weui_cell" href="<?php echo ('comment');?>">
            <div class="weui_cell_hd"><img src="/Public/images/comment.png" alt="" width="20"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的书评</p>
            </div>
            <div class="weui_cell_ft"> </div>
        </a>
        <a class="weui_cell" href="<?php echo ('corn');?>">
            <div class="weui_cell_hd"><img src="/Public/images/me.png" alt="" width="20"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的积分</p>
            </div>
            <div class="weui_cell_ft"> </div>
        </a>
        <a class="weui_cell" href="<?php echo ('guestbook');?>">
            <div class="weui_cell_hd"><img src="/Public/images/contment.png" alt="" width="20"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>留言反馈</p>
            </div>
            <div class="weui_cell_ft"> </div>
        </a>
    </div><?php endif; ?>
</div>
<div class="weui_btn_area">
    <a href="<?php echo U('public/logout');?>" class="weui_btn weui_btn_warn">注销帐号</a>
</div>

<div class="footer">
    <ul>
        <a href="<?php echo U('Index/index');?>" <?php if($foot == 1): ?>class="on"<?php endif; ?>><li><img src="http://wx.365xuet.com/Public/Weixin/images/footer-1-off.png"><img src="http://wx.365xuet.com/Public/Weixin/images/footer-1-on.png"><br><span>图书展示</span></li></a>
        <a href="<?php echo U('Libraryadmin/index');?>" <?php if($foot == 2): ?>class="on"<?php endif; ?>><li><img src="http://wx.365xuet.com/Public/Weixin/images/footer-2-off.png"><img src="http://wx.365xuet.com/Public/Weixin/images/footer-2-on.png"><br><span>分馆信息</span></li></a>
        <a href="<?php echo U('Mycenter/index');?>" <?php if($foot == 3): ?>class="on"<?php endif; ?>><li><img src="http://wx.365xuet.com/Public/Weixin/images/footer-4-off.png"><img src="http://wx.365xuet.com/Public/Weixin/images/footer-4-on.png"><br><span>我的</span></li></a>
    </ul>
</div>
<script>
    $(function () {
        check_login()
    });
    function check_login(type) {
        $.post("<?php echo U('Public/is_login');?>",{},function (data) {
                if (data.status==0){
                    login();
                }else {
                    if(type==1){
                        if (data.user.user_type==2){
                        window.location.href = "<?php echo U('Libraryadmin/index');?>"}
                        else {
                            $.confirm("请以管理员身份登录", function(){
                                login();
                            },function () {
                                //取消操作
                            })
                        }
                    }
                    if(type==2){
                        window.location.href = "<?php echo U('Mycenter/index');?>"
                    }
                }
        },"json");
    }
    function login(){
        var url = window.location.href;
        window.location.href = "/Home/Public/login?url=" + url;
    }
//    $(".footer ul a").click(function(){
//        $(".footer ul a").find("li img:odd").hide();
//        $(".footer ul a").find("li img:even").show();
//        $(this).find("img:eq(0)").hide();
//        $(this).find("img:eq(1)").show();
//    });
</script>
</body>
</html>