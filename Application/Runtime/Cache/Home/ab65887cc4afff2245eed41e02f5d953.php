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
    <div class="weui-row">
        <?php if(is_array($terms)): $i = 0; $__LIST__ = $terms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="weui-col-33" onclick="edit('<?php echo ($vo["id"]); ?>','<?php echo ($vo["name"]); ?>')"><?php echo ($vo["name"]); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="weui-col-33" onclick="add_term()">+</div>
    </div>
</div>
<div id="full" class='weui-popup-container'>
    <div class="weui-popup-overlay"></div>
    <div class="weui-popup-modal">
            <article class="weui_article">
                <div class="weui_cell_hd"><p>分类名称：</p>
                    <form action="<?php echo U('public/ajax_request');?>" method="post" id="form1">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="table_name" value="terms">
                        <input type="hidden" name="method" value="save">
                        <input type="text" class="weui_cell_hd" name="name" id="content">
                </form>
                </div>
                <section style="margin-top: 50vh">
                    <a href="javascript:;" class="weui_btn weui_btn_primary " id="save_name">保存</a>
                    <a href="javascript:;" class="weui_btn weui_btn_plain_primary close-popup">关闭</a>
                </section>

            </article>
    </div>
</div>
<div id="full2" class='weui-popup-container'>
    <div class="weui-popup-overlay"></div>
    <div class="weui-popup-modal">
        <article class="weui_article">
            <div class="weui_cell_hd"><p>分类名称：</p>
                <form action="<?php echo U('public/ajax_request');?>" method="post" id="form2">
                    <input type="hidden" name="table_name" value="terms">
                    <input type="hidden" name="method" value="add">
                    <input type="text" class="weui_cell_hd" name="name" >
                </form>
            </div>
            <section style="margin-top: 50vh">
                <a href="javascript:;" class="weui_btn weui_btn_primary " id="add_term">保存</a>
                <a href="javascript:;" class="weui_btn weui_btn_plain_primary close-popup">关闭</a>
            </section>

        </article>
    </div>
</div>
</body>
<script>
    $("#save_name").click(function() {
        $("#form1").ajaxSubmit({
            type:"post",
            dataType:"json",
            beforeSend:function () {
                $.showLoading("保存中")
            },
            success:function (data) {
                if (data.status==1){
                    $.hideLoading();
                    $.toast("提交成功",function () {
                        window.location.reload();
                    });
                }
                else{
                    $.hideLoading();
                    $.toast("提交失败","forbidden");
                }
            },
            error:function () {
                $.hideLoading();
                $.toptip('系统错误！');
            }
        });
    });
    $("#add_term").click(function() {
        $("#form2").ajaxSubmit({
            type:"post",
            dataType:"json",
            beforeSend:function () {
                $.showLoading("保存中")
            },
            success:function (data) {
                if (data.status==1){
                    $.hideLoading();
                    $.toast("提交成功",function () {
                        window.location.reload();
                    });
                }
                else{
                    $.hideLoading();
                    $.toast("提交失败","forbidden");
                }
            },
            error:function () {
                $.hideLoading();
                $.toptip('系统错误！');
            }
        });
    });
    function add_term() {
        $("#full2").addClass("weui-popup-container-visible");
        $("#full2").show();
    }
    function edit(id,name) {
        $.actions({
            title: "选择操作",
            onClose: function() {
            },
            actions: [
                {
                    text: "编辑",
                    className: "color-warning",
                    onClick: function() {
                        to_detail(id,name)
                    }
                },
                {
                    text: "删除",
                    className: 'color-danger',
                    onClick: function() {
                        delete_comment(id)
                    }
                }
            ]
        });
    }


    function  to_detail(id,name) {
        $("#content").val(name);
        $("#id").val(id);
        $("#full").addClass("weui-popup-container-visible");
        $("#full").show();
    }
    function delete_comment(id) {
        $.post("<?php echo U('public/ajax_request');?>",{id:id,method:"save",table_name:"terms",status:0},function (data) {
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