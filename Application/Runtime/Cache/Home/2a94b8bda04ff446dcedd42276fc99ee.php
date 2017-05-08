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
<div class="top">
    <div class="h-p">
        <div class="left-t">
            <div class="right-t-div">
                <input type="text" id="search" style="border: 0;height: 85%" placeholder="点击此处搜索" value="<?php echo ($name); ?>">
                <span class="right-t-l">
                    <img src="http://wx.365xuet.com/Public/Weixin/images/search-icon.png"/>
                </span>
            </div>
        </div>
        <div class="right-t"><a href="javascript:search_book();" class="weui_btn weui_btn_mini weui_btn_primary">查询</a>
        </div>
    </div>
</div>

<div class="book_list">
    <div class="weui_panel weui_panel_access">
        <div class="weui_panel_hd"></div>
        <?php if(!empty($book_list)): ?><div class="weui_panel_bd">
                <?php if(is_array($book_list)): $i = 0; $__LIST__ = $book_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="javascript:to_detail('<?php echo ($vo["ISBN"]); ?>')" class="weui_media_box weui_media_appmsg">


                        <div class="weui_media_hd " style="width: 25vw;height: 21vh">
                            <img class="book_listimg" src="<?php echo ($vo["book_pic"]); ?>" alt="">
                        </div>
                        <div class="weui_media_bd">
                            <h4 class="weui_media_title">书名:<?php echo ($vo["book_name"]); ?></h4>
                            <p class="weui_media_desc rigthheight">作者: <?php echo ($vo["book_author"]); ?></p>
                            <p class="weui_media_desc rigthheight">出版社:<?php echo ($vo["book_publisher"]); ?></p>
                            <p class="weui_media_desc rigthheight">定价:<?php echo ($vo["book_price"]); ?></p>
                            <p class="weui_media_desc rigthheight">库存:<?php echo ($vo["book_num"]); ?></p>
                        </div>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php else: ?>
            暂无相关内容！<?php endif; ?>
    </div>
</div>
<div id="full" class='weui-popup-container'>
    <div class="weui-popup-modal">
        <div class="weui_search_bar" id="search_bar">
            <form class="weui_search_outer" action="<?php echo U('home/index/index');?>" method="post">
                <div class="weui_search_inner">
                    <i class="weui_icon_search"></i>
                    <input type="search" name="book_name" class="weui_search_input" id="search_input" value="<?php echo ($name); ?>"
                           placeholder="请输入书名、作者或出版社" required/>
                    <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
                </div>
                <label for="search_input" class="weui_search_text" id="search_text">
                    <i class="weui_icon_search"></i>
                    <span>搜索</span>
                </label>
            </form>
            <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
        </div>
        <div class="weui-row">
            <?php if(is_array($terms)): $i = 0; $__LIST__ = $terms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="weui-col-33"><a href="<?php echo U('home/index/index',array('book_type'=>$vo[id]));?>"><?php echo ($vo["name"]); ?></a>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <section style="margin-top: 50vh">
            <a href="javascript:;" class="weui_btn weui_btn_plain_primary close-popup">关闭</a>
        </section>
    </div>
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
<script>
    $("#search").click(function () {
        search_book();
    });
    function search_book() {
        $("#full").addClass("weui-popup-container-visible");
        $("#full").show();
    }
    function to_detail(isbn) {
        window.location.href = "<?php echo U('home/bookadmin/index/isbn/" + isbn + "');?>";
    }
    //顶部搜索框变色
    $().ready(function () {
        (function () {
            pos = 0;
            ticking = false;
            var header = document.querySelector(".h-p");
            window.addEventListener("scroll", function (e) {
                pos = window.scrollY;
                if (pos > 100 && !ticking) {
                    header.classList.add("scrolledDown");
                    ticking = true;
                }
                if (pos < 100 && ticking) {
                    header.classList.remove("scrolledDown");
                    ticking = false;
                }
            });
        })();
    });
</script>
</html>