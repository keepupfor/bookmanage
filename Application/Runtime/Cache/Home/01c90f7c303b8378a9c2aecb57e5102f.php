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
    <!-- Standard iPhone -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png" />
    <!-- Retina iPhone -->
    <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-120x120.png" />
    <!-- Standard iPad -->
    <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-iphone-76x76.png" />
    <!-- Retina iPad -->
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-152x152.png" />
    <link rel="stylesheet" type="text/css" href="/bookmanage/Public/css/style.css">
    <script type="application/javascript" src="http://wx.365xuet.com/Public/Weui/js/jquery-2.1.4.js"></script>
    <script type="application/javascript" src="http://wx.365xuet.com/Public/Weui/js/jquery-weui.min.js"></script>
</head>
<title>图书借阅系统</title>
<body ontouchstart>
<div class="content">
<div class="header" style="z-index:5;">
    <a href="<?php echo ($url); ?>"><div class="left_t header_back">

    </div> </a>
    <div class="middle_t site_20">图书详情</div>
    <div class="right_t">
        <span class="rigth"></span>
    </div>
</div>

<div class="content_top">
    <div class="book_left">
        <img src="https://img3.doubanio.com/lpic/s29276401.jpg" alt=""></div>
    <div class="book_right">
        <span>书名:好好学习</span>
        <span >作者: 成甲</span>
        <span >出版社:中信出版社</span>
        <span >定价:42.00</span>
        <span >ISBN:9787508671581</span>

    </div>
</div>
  <div class="content_description">
      <dl>
          <dt>内容简介</dt>
          <dd class="nr"><p >
              为什么读了这么多书，依旧过不好这一生？因为大多数人都掉进了“低水平勤奋”的陷阱。我们读了很多书，却只是读到了一个个孤立的知识点，而并没有把新旧知识连成一张知识网，长成一棵知识树。学海真的无涯吗？到底什么样的“知识”值得我们花精力去学？知识无穷无尽，但掌控这个世界运行的底层规律是有限的。你需要的是从海量知识中辨别出其中的“王炸”，一通百通！学海非无涯，知识有主次。为什么学习“学习的方法”，比学习本身更重要？世界这么大，而我们的智慧有限。只有掌握了更有效的学习方法，才能在极为有限的时间里，把自己的认知水平比别人多往前推进一厘米。拥有学习力的人，才拥有这个时代的终极竞争力如何从“知道”到“做到”？怎么才能让知识变现？刻意练习+多场景思维训练=构建底层认知，打通知识的底层结构让知识成为资产，让学习成为财富积累的过程！
              </p></dd>
          <a  onclick="showall('nr')" class="nr">查看全部>>></a>
          <dt>作者简介</dt>
          <dd class="zz"><p >
              成甲。很多人是从罗辑思维“得到”App的音频节目《成甲说书》了解我的。在与罗辑思维合作的过程中，我有幸入选了罗辑思维评选的“中国最会学习的人”，而2016年“得到”年终盘点全年销量TOP 10的节目中，《成甲说书》占了三成。我是怎么做到这一点的？除了大量阅读外，《好好学习》这本书详细介绍了背后的方法。我主业是做景区设计咨询，2009年联合创办了北京京都风景生态旅游规划设计院，并担任常务副院长。很多人奇怪为什么我要不务正业去研究认知思维，去运营一个知识管理的公号，去写一本知识管理的书？我还曾多次受邀在清华MBA、第九学院、多角度沙龙、中国惠普、埃森哲、中国人寿集团等机构团队进行演讲，做关于个人时间管理、知识管理方面的课程和分享。其实不管是主业、副业，我都是在做同一件事情：深入思考问题，热情分享经验，激发别人潜能。
              </p></dd>
          <a  onclick="showall('zz')" class="zz">查看全部>>></a>
      </dl>
  </div>
    <div class="content_bottom">
        <a href="#" class="weui_btn weui_btn_primary">借书</a>
    </div>
</div>
<script>
    function showall(p) {
        $("a."+p).remove();
        $("dd."+p).css("height",'auto');
    }
</script>
</body>
</html>