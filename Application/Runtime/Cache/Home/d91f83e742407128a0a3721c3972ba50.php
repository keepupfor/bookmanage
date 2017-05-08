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
<div class="header" style="z-index:5;">
    <a href="<?php echo U('Libraryadmin/index');?>"><div class="left_t header_back">

    </div> </a>
    <div class="middle_t site_20">图书管理</div>
    <div class="right_t">
        <span class="rigth" id="add_info">
            添加
        </span>
    </div>
</div>
<div class="content_normal">
    <div class="weui_navbar" style="position: fixed;top: 50px;">
        <div class="weui_navbar_item <?php if($status == 1): ?>weui_bar_item_on<?php endif; ?> " onclick="location.href='<?php echo U('home/libraryadmin/book_manage/status/1');?>'">
           已上架
        </div>
       <div class="weui_navbar_item  <?php if($status == 2): ?>weui_bar_item_on<?php endif; ?>" onclick="location.href='<?php echo U('home/libraryadmin/book_manage/status/2');?>'">
            未上架
        </div>
    </div>

</div>
<div class="book_list" style="position: absolute;">
    <div class="weui_panel weui_panel_access">
        <div class="weui_panel_bd">
            <?php if(is_array($book_list)): $i = 0; $__LIST__ = $book_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a  href="javascript:;" onclick="go_detail('<?php echo ($vo["ISBN"]); ?>')" class="weui_media_box weui_media_appmsg">
                <div class="weui_media_hd " style="width: 25vw;height: 21vh">
                    <img class="book_listimg" src="<?php echo ($vo["book_pic"]); ?>" alt="">
                </div>
                <div class="weui_media_bd">
                    <b class="weui_media_desc rigthheight">书名:<?php echo ($vo["book_name"]); ?></b>
                    <p class="weui_media_desc rigthheight">作者: <?php echo ($vo["book_author"]); ?></p>
                    <p class="weui_media_desc rigthheight">出版社:<?php echo ($vo["book_publisher"]); ?></p>
                    <p class="weui_media_desc rigthheight">出版日期:<?php echo ($vo["book_pubdate"]); ?></p>
                    <p class="weui_media_desc rigthheight">定价:<?php echo ($vo["book_price"]); ?></p>
                    <p class="weui_media_desc rigthheight">库存:<?php echo ($vo["book_num"]); ?></p>
                </div>
            </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>
<div id="full" class='weui-popup-container'>
    <div class="weui-popup-overlay"></div>
    <div class="weui-popup-modal">
        <div class="weui_search_bar" id="search_bar" >
            <form class="weui_search_outer" method="post" id="isbnform" action="<?php echo U('home/libraryadmin/set_qrcode');?>">
                <div class="weui_search_inner">
                    <i class="weui_icon_search"></i>
                    <input type="search" name="isbn" class="weui_search_input" id="search_input" placeholder="输入图书ISBN码" required/>
                    <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
                </div>
                <label for="search_input" class="weui_search_text" id="search_text">
                    <i class="weui_icon_search"></i>
                    <span>输入图书ISBN码</span>
                </label>
            </form>
            <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
        </div>
        <article class="weui_article">
        <section>
            <div id="qrcode" style="width: 100%;text-align: center"></div>
            <img src="" alt="">
            <a href="javascript:;" class="weui_btn weui_btn_primary" id="save_info">生成二维码</a>
            <a href="javascript:;" class="weui_btn weui_btn_plain_primary close-popup">关闭</a>
        </section>
            </article>
    </div>

</div>
</body>
<script>
    function go_detail(isbn) {
      window.location.href=" <?php echo U('home/Bookadmin/index/isbn/"+isbn+"');?>"
    }
    $(document).on("click", "#add_info", function() {
        $("#full").addClass("weui-popup-container-visible");
        $("#full").show();
    }).on("open", ".weui-popup-modal", function() {
    }).on("close", ".weui-popup-modal", function() {
    }).on("click","#save_info",function () {
        $("#isbnform").ajaxSubmit({
            type:"post",
            dataType:"json",
            success:function (data) {
                var html='<img src="data:image/png;base64,'+data.base+'">';
                $("#qrcode").html(html);
            }
        });
    });
</script>
</html>