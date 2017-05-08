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
        <?php if($user_type == 2): ?><span class="rigth" id="add_info">
            添加
        </span><?php endif; ?>
    </div>
</div>
<div class="content_normal">

    <div class="weui_panel">
        <!--<div class="weui_panel_hd"><?php echo ($title); ?></div>-->
        <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="weui_panel_bd" onclick="to_detail('<?php echo ($vo["id"]); ?>')">
            <div class="weui_media_box weui_media_text">
                <h4 class="weui_media_title"><?php echo ($vo["title"]); ?></h4>
                <p class="weui_media_desc"><?php echo ($vo["content"]); ?></p>
                <ul class="weui_media_info">
                    <li class="weui_media_info_meta"><?php if($vo["is_top"] == 1): ?><a href="javascript:;" style="color: orangered">置顶</a><?php endif; ?></li>
                    <li class="weui_media_info_meta"><?php echo (msubstr($vo["addtime"],0,10,'utf-8',false)); ?></li>
                </ul>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<div id="full" class='weui-popup-container'>
    <div class="weui-popup-overlay"></div>
    <div class="weui-popup-modal">
        <form  name="form1" id="form1" enctype="multipart/form-data" action="<?php echo U('public/ajax_request');?>" method="post">
            <article class="weui_article">
                <div class="weui_cell_hd"><label class="weui_label">标题</label></div>
                <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" type="text" placeholder="请输入标题" name="title" value="<?php echo ($info['title']); ?>">
                        </div>
                    </div>
                </div>
                <div class="weui_cell_hd"><label class="weui_label">内容</label></div>
                <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">
                            <textarea class="weui_textarea" placeholder="请输入内容" name="content" rows="6"><?php echo ($info['content']); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="weui_cell weui_cell_switch">
                    <div class="weui_cell_hd weui_cell_primary">是否置顶</div>
                    <div class="weui_cell_ft">
                        <input class="weui_switch" type="checkbox">
                    </div>
                </div>
                <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">
                            <div class="weui_uploader">
                                <div class="weui_uploader_hd weui_cell">
                                    <div class="weui_cell_bd weui_cell_primary">图片上传</div>
                                </div>
                                <div class="weui_uploader_bd">
                                    <ul class="weui_uploader_files">
                                        <li class="weui_uploader_file" style="margin-top:10px;width: 29%" id="image"></li>
                                        <li class="weui_uploader_file" style="margin-top:10px;width: 29%">
                                            <div class="weui_uploader_input_wrp" style="float: left">
                                                <input class="weui_uploader_input" type="file"  name="img" id="img">
                                            </div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="is_top" id="is_top" value="0">
                <input type="hidden" name="table_name" value="news">
                <input type="hidden" name="type" value="<?php echo ($type); ?>">
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
    $(function () {
        var va;
        $(".weui_switch").bind("click", function () {
            ($(".weui_switch").prop("checked"))? va=1 : va=0;
            $("#is_top").val(va);
        });
    });
    function  to_detail(id) {
        window.location.href="<?php echo U('home/libraryadmin/library_information_detail/id/"+id+"');?>";
    }
    //图片显示插件
    $.imageFileVisible({
        wrapSelector: "#image",
        fileSelector: "#img",
        width: 60,
        height: 60,
        num:1
    });
    $(document).on("click", "#add_info", function() {
        $("#full").addClass("weui-popup-container-visible");
        $("#full").show();
    }).on("open", ".weui-popup-modal", function() {
    }).on("close", ".weui-popup-modal", function() {
    }).on("click","#save_info",function () {
        $("#form1").ajaxSubmit({

            type:"post",
            dataType:"json",
            data:{method:"add"},
            success:function (data) {
                if (data.status==1){
                    $.toast("添加成功",function () {
                        location.href=location.href;
                    });
                }
            }
        });
    });
</script>
</html>