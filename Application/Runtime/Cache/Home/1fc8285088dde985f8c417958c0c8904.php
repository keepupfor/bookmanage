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
    <title>图书订阅管理系统</title>
<body ontouchstart style="background: white">

<div class="header" style="z-index:5;">
    <a href="<?php echo U('mycenter/index');?>"><div class="left_t header_back">

    </div> </a>
    <div class="middle_t site_20">我的预约</div>
    <div class="right_t">
        <span class="rigth" id="add_info">
        </span>
    </div>
</div>
<div class="content_normal">

            <div class="weui_panel weui_panel_access">
                <div class="weui_panel_bd">
                    <?php if(is_array($ap_list)): $i = 0; $__LIST__ = $ap_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" onclick="go_detail('<?php echo ($vo[book_detail][ISBN]); ?>')">

                        <div class="weui_media_hd">
                            <img class="weui_media_appmsg_thumb" src="<?php echo ($vo[book_detail][book_pic]); ?>" alt="">
                        </div>
                        <div class="weui_media_bd " >
                            <h4 class="weui_media_title"><?php echo ($vo[book_detail][book_name]); ?></h4>
                            <p class="weui_media_desc"><?php echo ($vo[book_detail][book_content]); ?></p>
                            <p class="weui_media_desc" style="color: orange">预约时间：<?php echo ($vo["addtime"]); ?></p>
                        </div>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
    </div>

</body>
<script>

</script>
</html>