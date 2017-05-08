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
<style>
   .content_top ul li{
        border-radius: 15vw;
        background: wheat;
        list-style: none;
        width: 21vw;
        height: 22vw;
        float: left;
        text-align: center;
        line-height: 14vh;
        margin: 5vw 3vw 2vw 7vw;
        font-size: 12px;
    }
</style>
<body ontouchstart style="background: white">

<div class="header" style="z-index:5;text-align: center">
    馆内信息
</div>
<div class="content_normal" style="margin-top: 65px">
    <div class="swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php if(is_array($swiper_img)): $i = 0; $__LIST__ = $swiper_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide"><img src="<?php echo ($vo); ?>" /></div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>

<nav class="ma_top">
    <table cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <td width="33%"><a href="<?php echo U('library_information',array('type'=>0));?>" class="img">馆内介绍</a></td>
            <td width="33%"><a href="<?php echo U('library_information',array('type'=>1));?>" class="img2">馆内新闻</a></td>
            <td width="33%"><a href="<?php echo U('library_information',array('type'=>2));?>" class="img3">馆内公告</a></td>
        </tr>
        <tr></tr>
        <?php if($user_type == 2): ?><tr>
            <td width="33%"><a href="<?php echo U('book_manage');?>" class="img7">图书管理</a></td>
            <td width="33%"><a href="<?php echo U('reader_manage');?>" class="img9">借阅管理</a></td>
            <td width="33%"><a href="<?php echo U('appointment_manage');?>" class="img11">预约管理</a></td>

        </tr>

        <tr></tr><?php endif; ?>
        <tr>
            <td width="33%"><a href="<?php echo U('library_information',array('type'=>5));?>" class="img4">馆内讲座</a></td>
            <td width="33%"><a href="<?php echo U('library_information',array('type'=>4));?>" class="img6">馆内课程</a></td>
            <td width="33%"><a href="<?php echo U('library_information',array('type'=>3));?>" class="img5">馆内活动</a></td>
        </tr>
        <tr></tr>
        <?php if($user_type == 2): ?><tr>
            <td width="33%"><a href="<?php echo U('book_comment');?>" class="img8">书评管理</a></td>
            <td width="33%"><a href="<?php echo U('book_message');?>" class="img10">留言管理</a></td>
            <td width="33%"><a href="<?php echo U('book_terms');?>" class="img12">分类管理</a></td>
        </tr>
        <tr></tr><?php endif; ?>
        </tbody>
    </table>
</nav>
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
<script>
    $(".swiper-container").swiper({
        loop: true,
        autoplay: 3000
    });
</script>
</html>