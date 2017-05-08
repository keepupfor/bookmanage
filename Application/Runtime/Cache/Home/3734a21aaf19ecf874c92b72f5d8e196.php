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
    <a href="<?php echo U('Libraryadmin/library_information',array('type'=>$type));?>"><div class="left_t header_back">

    </div>
    <div class="middle_t site_20"><?php echo ($title); ?></div>
    <div class="right_t">
        <?php if($user_type == 2): ?><span class="rigth" id="manage">
            管理
        </span><?php endif; ?>
    </div>
</div>
<div class="content_normal">

        <article class="weui_article">
                <section>
                    <img src="<?php echo ($info["img"]); ?>" alt="">
                    <h3><?php echo ($info["title"]); ?></h3>
                    <p><?php echo ($info["content"]); ?></p>
                </section>
        </article>
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

            <div class="weui_cells weui_cells_form">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <div class="weui_uploader">
                            <div class="weui_uploader_hd weui_cell">
                                <div class="weui_cell_bd weui_cell_primary">图片上传</div>
                            </div>
                            <div class="weui_uploader_bd">
                                <ul class="weui_uploader_files">
                                    <li class="weui_uploader_file" style="margin-top:10px;width: 29%" >
                                        <img  style="height: 60px;width:60px"src="<?php echo ($info["img"]); ?>" >
                                    </li>
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
            <input type="hidden" name="id" value="<?php echo ($info['id']); ?>">
            <input type="hidden" name="table_name" value="news">
            <section>
                <a href="javascript:;" class="weui_btn weui_btn_primary" id="save_info">保存</a>
                <a href="javascript:;" class="weui_btn weui_btn_plain_primary close-popup">关闭</a>
            </section>

        </article>
        </form>
    </div>
    </div>
<script>

    //图片显示插件
    $.imageFileVisible({
        wrapSelector: "#image",
        fileSelector: "#img",
        width: 60,
        height: 60,
        num:1
    });
    $(document).on("click", "#manage", function() {
        var re="<?php echo ($handle['result']); ?>";
        var id="<?php echo ($info['id']); ?>";
        $.actions({
            title: "选择操作",
            onClose: function() {
            },
            actions: [
                {
                    text: "<?php echo ($handle['title']); ?>",
                    className: "color-primary",
                    onClick: function() {
                        $.post("<?php echo U('public/ajax_request');?>",{method:"save",table_name:"news",is_top:re,id:id},function (data) {
                            if (data.status==1){
                                $.toast("<?php echo ($handle['title']); ?>成功",function () {
                                    location.href=location.href;
                                });
                            }
                            else {
                                $.toast("<?php echo ($handle['title']); ?>失败","forbidden");
                            }
                        })
                    }
                },
                {
                    text: "编辑",
                    className: "color-warning",
                    onClick: function() {
                        $("#full").addClass("weui-popup-container-visible");
                        $("#full").show();
                    }
                },
                {
                    text: "删除",
                    className: 'color-danger',
                    onClick: function() {
                        $.post("<?php echo U('public/ajax_request');?>",{method:"save",table_name:"news",status:0,id:id},function (data) {
                            if (data.status==1){
                                $.toast("删除成功",function () {
                                    location.href="<?php echo ($url); ?>";
                                });
                            }
                            else {
                                $.toast("删除失败","forbidden");
                            }
                        })
                    }
                }
            ]
        });
    }).on("open", ".weui-popup-modal", function() {
    }).on("close", ".weui-popup-modal", function() {
    }).on("click","#save_info",function () {
        $("#form1").ajaxSubmit({
            type:"post",
            dataType:"json",
            success:function (data) {
                    if (data.status==1){
                        $.toast("修改成功",function () {
                            location.href=location.href;
                        });
                    }
                    else{
                        $.toast("修改失败","forbidden");
                    }
            }
        });
    });
</script>
</body>
</html>