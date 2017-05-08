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
    <div class="middle_t site_20">我的借阅</div>
    <div class="right_t">
        <span class="rigth" id="add_info">
        </span>
    </div>
</div>
<div class="content_normal">
    <div class="weui_navbar" style="position: fixed;top: 50px;">
        <div class="weui_navbar_item <?php if($type == 1): ?>weui_bar_item_on<?php endif; ?> " onclick="location.href='<?php echo U('home/mycenter/order/type/1');?>'">
           借阅中
        </div>
        <div class="weui_navbar_item  <?php if($type == 2): ?>weui_bar_item_on<?php endif; ?>" onclick="location.href='<?php echo U('home/mycenter/order/type/2');?>'">
            已借阅
        </div>
    </div>
</div>
<div class="book_list" style="position: absolute;">
            <div class="weui_panel weui_panel_access" >
                <div class="weui_panel_bd">
                    <?php if(is_array($or_list)): $i = 0; $__LIST__ = $or_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" >

                        <div class="weui_media_hd" style="height: 21vh" onclick="go_detail('<?php echo ($vo[book_detail][ISBN]); ?>')">
                            <img class="weui_media_appmsg_thumb" src="<?php echo ($vo[book_detail][book_pic]); ?>" alt="">
                        </div>
                        <div class="weui_media_bd " >
                            <h4 class="weui_media_title" onclick="go_detail('<?php echo ($vo[book_detail][ISBN]); ?>')"><?php echo ($vo[book_detail][book_name]); ?></h4>
                            <p class="weui_media_desc" onclick="go_detail('<?php echo ($vo[book_detail][ISBN]); ?>')"><?php echo ($vo[book_detail][book_content]); ?></p>
                            <p class="weui_media_desc" style="color: orange">申请时间：<?php echo ($vo["addtime"]); ?></p>
                            <?php if($type == 1): ?><p class="weui_media_desc" style="color: red">应还时间：<?php echo ($vo["back_time"]); ?></p><?php endif; ?>
                             <?php if($type == 2): ?><p class="weui_media_desc" style="color: red">还书时间：<?php echo ($vo["back_real_time"]); ?></p>
                                 <span  onclick="javascript:comment_book('<?php echo ($vo["book_id"]); ?>');" class="weui_btn weui_btn_mini weui_btn_default">
                                     评论
                                 </span><?php endif; ?>

                        </div>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
</div>
<div id="full" class='weui-popup-container'>
    <div class="weui-popup-overlay"></div>
    <div class="weui-popup-modal">
        <form  name="form1" id="form1" enctype="multipart/form-data" action="<?php echo U('public/ajax_request');?>" method="post">
            <article class="weui_article">
                <div class="weui_cell_hd"><label class="weui_label">评论内容</label></div>
                <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">
                            <textarea class="weui_textarea" placeholder="请输入评论内容" name="content" rows="6"><?php echo ($info['content']); ?></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="uid" value="<?php echo ($id); ?>">
                <input type="hidden" name="table_name" value="comments">
                <input type="hidden" name="post_id" id="post_id">
                <section>
                    <a href="javascript:;" class="weui_btn weui_btn_primary" id="save_info">确定提交</a>
                    <a href="javascript:;" class="weui_btn weui_btn_plain_primary close-popup">关闭</a>
                </section>

            </article>
        </form>
    </div>
</div>
</body>
<script>
    $(document).on("click","#save_info",function () {
                $("#form1").ajaxSubmit({
                    type:"post",
                    dataType:"json",
                    data:{method:"add"},
                    success:function (data) {
                        if (data.status==1){
                            $.toast("评论成功",function () {
                                location.href=location.href;
                            });
                        }
                    }
                });
            });
function comment_book(book_id) {
    $("#post_id").val(book_id);
    $("#full").addClass("weui-popup-container-visible");
    $("#full").show();
}
</script>
</html>