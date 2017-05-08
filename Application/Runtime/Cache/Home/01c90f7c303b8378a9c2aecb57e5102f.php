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
    .hide{display: none}
</style>
<body ontouchstart>
<div class="content">
<div class="header" style="z-index:5;">
    <div class="left_t header_back">

    </div>
    <div class="middle_t site_20">图书详情</div>
    <div class="right_t">
        <?php if($user_type == 2): ?><span class="rigth" id="manage">
            管理
        </span><?php endif; ?>
        <?php if($user_type == 1): ?><span class="rigth <?php if($is_favorite == 1): ?>hide<?php endif; ?>" id="favorite">
            收藏
        </span>


            <span class="rigth <?php if($is_favorite == 0): ?>hide<?php endif; ?>" id="cancel_favorite">
            已收藏
        </span><?php endif; ?>
    </div>
</div>
    <div class="book_list" style="position: relative">
<div class="weui_panel weui_panel_access">
<div class="weui_panel_bd">
    <a href="javascript:;" class="weui_media_box weui_media_appmsg">
        <div class="weui_media_hd " style="width: 25vw;height: 21vh">
            <img class="book_listimg" src="<?php echo ($info["book_pic"]); ?>" alt="">
        </div>
        <div class="weui_media_bd">
            <b class="weui_media_desc rigthheight">书名:<?php echo ($info["book_name"]); ?></b>
            <p class="weui_media_desc rigthheight">作者: <?php echo ($info["book_author"]); ?></p>
            <p class="weui_media_desc rigthheight">出版社:<?php echo ($info["book_publisher"]); ?></p>
            <p class="weui_media_desc rigthheight">出版日期:<?php echo ($info["book_pubdate"]); ?></p>
            <p class="weui_media_desc rigthheight">定价:<?php echo ($info["book_price"]); ?></p>
            <p class="weui_media_desc rigthheight">库存:<?php echo ($info["book_num"]); ?></p>
        </div>
    </a>
</div>
</div>
    </div>
  <div class="content_description">
      <dl>
          <dt>内容简介</dt>
          <dd class="nr"><p >
              <?php echo ($info["book_content"]); ?>
              </p></dd>
          <a  onclick="showall('nr')" class="nr">查看全部>>></a>
      </dl>
  </div>
    <script>
        function GetRTime(time,num) {
            setInterval(function(){
                var EndTime = new Date(time);
                var NowTime = new Date();
                var t = EndTime.getTime() - NowTime.getTime();
                //alert(t);
                var d = Math.floor(t / 1000 / 60 / 60 / 24);
                var h = Math.floor(t / 1000 / 60 / 60 % 24);
                var m = Math.floor(t / 1000 / 60 % 60);
                var s = Math.floor(t / 1000 % 60);

                if(t>0){
                    var _html='「还书时间」'+'<span id="t_d">'+d+'天</span><span id="t_h">'+h+'时</span><span id="t_m">'+m+'分</span><span id="t_s">'+s+'秒</span>';
                    document.getElementById("t_d"+num).innerHTML =_html;
                }
                else {
                    var t2 = NowTime.getTime()- EndTime.getTime() ;
                    //alert(t);
                    var d2 = Math.floor(t2 / 1000 / 60 / 60 / 24);
                    var h2 = Math.floor(t2 / 1000 / 60 / 60 % 24);
                    var m2 = Math.floor(t2 / 1000 / 60 % 60);
                    var s2 = Math.floor(t2 / 1000 % 60);
                    var _html='「已逾期」'+'<span id="t_d">'+d2+'天</span><span id="t_h">'+h2+'时</span><span id="t_m">'+m2+'分</span><span id="t_s">'+s2+'秒</span>';
                    document.getElementById("t_d"+num).innerHTML =_html;
                }


                // document.getElementById("t_h").innerHTML = h + "时";
                // document.getElementById("t_m").innerHTML = m + "分";
                // document.getElementById("t_s").innerHTML = s + "秒";
            },1000)

        }
    </script>
    <?php if($user_type == 1): ?><div class="content_bottom">
        <?php if($is_order == 1): switch($order_one['status']): case "0": ?><a href="javascript:;" class="weui_btn weui_btn_primary">申请中</a><?php break;?>
            <?php case "1": ?><a href="javascript:get_book(2);" class="weui_btn weui_btn_primary">取书</a><?php break;?>
             <?php case "2": ?><a  href="javascript:check_time(3);" class="weui_btn weui_btn_mini weui_btn_default">
                     还书
                 </a>
                 <a id="t_d1" href="javascript:;" class="weui_btn weui_btn_mini weui_btn_primary">
                    <script>GetRTime('<?php echo ($order_one["back_time2"]); ?>',1);</script>
                     </a><?php break; endswitch; endif; ?>
        <?php if($is_order == 0): switch($info['book_num']): case "0": ?><a href="javascript:order_book(2);" class="weui_btn weui_btn_primary">预约</a><?php break;?>
            <?php default: ?>
                <a href="javascript:order_book(1);" class="weui_btn weui_btn_primary">借书</a><?php endswitch; endif; ?>
    </div><?php endif; ?>
</div>
<div id="full" class='weui-popup-container'>
    <div class="weui-popup-overlay"></div>
    <div class="weui-popup-modal">
        <form  name="form1" id="form1" enctype="multipart/form-data" action="<?php echo U('public/ajax_request');?>" method="post">
            <article class="weui_article">

                <div class="weui_cells weui_cells_form">

                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">库存</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" type="text" placeholder="请输入库存" name="book_num" value="<?php echo ($info["book_num"]); ?>">
                        </div>
                    </div>
                </div>
                <div class="weui_cell weui_cell_select">
                    <div class="weui_cell_hd" style="padding-left: 15px"><label class="weui_label">分类</label></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <select class="weui_select" name="book_type">
                            <option <?php if($info[book_type] == 0): ?>selected="selected"<?php endif; ?> value="0">未分类</option>
                           <?php if(is_array($terms)): $i = 0; $__LIST__ = $terms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($info[book_type] == $vo[id]): ?>selected="selected"<?php endif; ?>  value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo ($info['id']); ?>">
                <input type="hidden" name="table_name" value="details">
                <section style="margin-top: 10vh">
                    <a href="javascript:;" class="weui_btn weui_btn_primary" id="save_info">保存</a>
                    <a href="javascript:;" class="weui_btn weui_btn_plain_primary close-popup">关闭</a>
                </section>

            </article>
        </form>
    </div>
</div>
<script>
    function order_book(order_type) {
        var handle='';
        order_type==1? handle='借阅':handle='预约';
        var id="<?php echo ($info['id']); ?>";
        var user_id="<?php echo ($id); ?>";
        var data={book_id:id,user_id:user_id,order_type:order_type};
        $.post("<?php echo U('bookadmin/order_book');?>",data,function (data) {
            if (data.status==1){
                $.toast(handle+"成功",function () {
                    location.href=location.href;
                });
            }
            else {
                $.toast(handle+"失败","forbidden");
            }
        })
    }
    function get_book(status) {
        var id="<?php echo ($order_one['id']); ?>";
        $.post("<?php echo U('bookadmin/get_book');?>",{status:status,id:id},function (data) {
            if (data.status==1){
                $.toast("取书成功",function () {
                    location.href=location.href;
                });
            }
            if (data.status==-1){
                $.alert(data.info,function () {
                    location.href=location.href;
                });
            }
            if (data.status==0) {
                $.toast("取书失败","forbidden");
                location.href=location.href;
            }
        })
    }
    function check_time(status) {
        var back_time="<?php echo ($order_one['back_time']); ?>";
        $.post("<?php echo U('bookadmin/check_time');?>",{back_time:back_time},function (data) {
            if (data.status==1){
               back_book(status)
            }
            else {
               $.confirm("因为您已逾期"+data.over_time+"天,此次还书需要花费"+data.price+"元",function () {
                   $.modal({
                       title: "支付",
                       text: "选择支付方式",
                       buttons: [
                           { text: "支付宝", onClick: function(){ $.alert("你选择了支付宝",function () {
                               back_book(status);
                           }); } },
                           { text: "微信", onClick: function(){ $.alert("你选择了微信支付",function () {
                               back_book(status);
                           }); } },
                           { text: "网银", onClick: function(){ $.alert("你选择了微信支付",function () {
                               back_book(status);
                           }); } },
                           { text: "取消", className: "default"},
                       ]
                   });

               })
            }
        })
    }
    function back_book(status) {
        var id="<?php echo ($order_one['id']); ?>";
        var book_id="<?php echo ($info["id"]); ?>";
        $.post("<?php echo U('bookadmin/back_book');?>",{book_id:book_id,status:status,id:id},function (data) {
            if (data.status==1){
                $.toast("还书成功",function () {
                    location.href=location.href;
                });
            }
            else {
                $.toast("还书失败","forbidden");
                location.href=location.href;
            }
        })
    }
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
                        $.post("<?php echo U('public/ajax_request');?>",{method:"save",table_name:"details",status:re,id:id},function (data) {
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
                        $.confirm("删除后将无法恢复，确定删除吗？",function () {
                            $.post("<?php echo U('public/ajax_request');?>",{method:"delete",table_name:"details",status:0,id:id},function (data) {
                                if (data.status==1){
                                    $.toast("删除成功",function () {
                                        location.href="<?php echo ($url); ?>";
                                    });
                                }
                                else {
                                    $.toast("删除失败","forbidden");
                                }
                            })

                        })
                    }
                }
            ]
        });
    }).on("open", ".weui-popup-modal", function() {
    }).on("close", ".weui-popup-modal", function() {
    }).on("click","#save_info",function () {
        if (parseInt($("input[name='book_num']").val()) <0){
            $.toast("库存数不能小于0","forbidden");
            return false;
        }
        $("#form1").ajaxSubmit({

            type:"post",
            dataType:"json",
            data:{method:"save"},
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
    }).on("click","#favorite",function () {

        var uid="<?php echo ($id); ?>";
        var objectid="<?php echo ($info["id"]); ?>";
        $.post("<?php echo U('public/ajax_request');?>",{method:"add",table_name:"favorites",uid:uid,object_id:objectid},function (data) {
            if (data.status==1){
                    $("#cancel_favorite").css("display","block");
                    $("#favorite").hide();
            }
            else {
                $.toast("收藏失败","forbidden");
            }
        })
    }).on("click","#cancel_favorite",function () {

        var id="<?php echo ($favorite['id']); ?>";
        $.post("<?php echo U('public/ajax_request');?>",{method:"save",table_name:"favorites",id:id,status:2},function (data) {
            if (data.status==1){
                    $("#favorite").css("display","block");
                    $("#cancel_favorite").hide();
            }
            else {
                $.toast("取消收藏失败","forbidden");
            }
        })
    });

    function showall(p) {
        $("a."+p).remove();
        $("dd."+p).css("height",'auto');
    }
    $(".header_back").click(function () {
        window.history.back();
    })
</script>
</body>
</html>