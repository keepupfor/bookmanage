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
    <a href="<?php echo U('Libraryadmin/index');?>"><div class="left_t header_back">

    </div> </a>
    <div class="middle_t site_20"><?php echo ($title); ?></div>
    <div class="right_t">
        <span class="rigth" id="add_info">
        </span>
    </div>
</div>
<div class="content_normal">

    <div class="weui_panel">
        <!--<div class="weui_panel_hd"><?php echo ($title); ?></div>-->
        <?php if(is_array($guestbook)): $i = 0; $__LIST__ = $guestbook;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="weui_panel_bd">
            <div class="weui_media_box weui_media_text">
                <h4 class="weui_media_title" onclick="to_detail('<?php echo ($vo["msg"]); ?>')">标题：<?php echo ($vo['title']); ?></h4>
                <p class="weui_media_desc" onclick="to_detail('<?php echo ($vo["msg"]); ?>')">内容：<?php echo ($vo['msg']); ?></p>
                <ul class="weui_media_info">
                    <li class="weui_media_info_meta">留言用户：<?php echo ($vo["full_name"]); ?></li>
                    <li class="weui_media_info_meta">留言时间：<?php echo ($vo["addtime"]); ?></li>
                </ul>
                <a href="javascript:;" class="weui_btn weui_btn_mini weui_btn_primary" onclick="delete_comment('<?php echo ($vo["id"]); ?>')" >删除</a>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<div id="full" class='weui-popup-container'>
    <div class="weui-popup-overlay"></div>
    <div class="weui-popup-modal">
            <article class="weui_article">
                <div class="weui_cell_hd"><p>留言内容：</p><label class="weui_cell_hd" id="content"></label></div>
                <section style="margin-top: 50vh">
                    <a href="javascript:;" class="weui_btn weui_btn_plain_primary close-popup">关闭</a>
                </section>

            </article>
    </div>
</div>
</body>
<script>
    function  to_detail(content) {
        $("#content").html(content);
        $("#full").addClass("weui-popup-container-visible");
        $("#full").show();
    }
    function delete_comment(id) {
        $.post("<?php echo U('public/ajax_request');?>",{id:id,method:"save",table_name:"guestbook",status:0},function (data) {
            if (data.status==1){
                $.toast("删除成功",function () {
                    location.href=location.href;
                });
            }
            if (data.status==0){
                $.toast("删除失败","forbidden",function () {
//                    location.href=location.href;
                });
            }
        })
    }
</script>
</html>