<?php

header("Content-type:text/html;charset=utf-8");


/*************************** api开发辅助函数 **********************/

/**
 * @param null $msg  返回正确的提示信息
 * @param flag success CURD 操作成功
 * @param array $data 具体返回信息
 * Function descript: 返回带参数，标志信息，提示信息的json 数组
 *
 */
function returnApiSuccess($msg = null,$data = array()){
    $result = array(
        'flag' => 'Success',
        'msg' => $msg,
        'data' =>$data
    );
    print json_encode($result);
}

/**
 * @param null $msg  返回具体错误的提示信息
 * @param flag success CURD 操作失败
 * Function descript:返回标志信息 ‘Error'，和提示信息的json 数组
 */
function returnApiError($msg = null){
    $result = array(
        'flag' => 'Error',
        'msg' => $msg,
    );
    print json_encode($result);
}

/**
 * @param null $msg  返回具体错误的提示信息
 * @param flag success CURD 操作失败
 * Function descript:返回标志信息 ‘Error'，和提示信息，当前系统繁忙，请稍后重试；
 */
function returnApiErrorExample(){
    $result = array(
        'flag' => 'Error',
        'msg' => '当前系统繁忙，请稍后重试！',
    );
    print json_encode($result);
}

/**
 * @param null $data
 * @return array|mixed|null
 * Function descript: 过滤post提交的参数；
 *
 */

function checkDataPost($data = null){
    if(!empty($data)){
        $data = explode(',',$data);
        foreach($data as $k=>$v){
            if((!isset($_POST[$k]))||(empty($_POST[$k]))){
                if($_POST[$k]!==0 && $_POST[$k]!=='0'){
                    returnApiError($k.'值为空！');
                }
            }
        }
        unset($data);
        $data = I('post.');
        unset($data['_URL_'],$data['token']);
        return $data;
    }
}

/**
 * @param null $data
 * @return array|mixed|null
 * Function descript: 过滤get提交的参数；
 *
 */
function checkDataGet($data = null){
    if(!empty($data)){
        $data = explode(',',$data);
        foreach($data as $k=>$v){
            if((!isset($_GET[$k]))||(empty($_GET[$k]))){
                if($_GET[$k]!==0 && $_GET[$k]!=='0'){
                    returnApiError($k.'值为空！');
                }
            }
        }
        unset($data);
        $data = I('get.');
        unset($data['_URL_'],$data['token']);
        return $data;
    }
}

/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
}
/**
 * 返回用户id
 * @return integer 用户id
 */
function get_type($type){
    switch ($type){
        case 0:$type='管内介绍';break;
        case 1:$type='管内新闻';break;
        case 2:$type='管内公告';break;
        case 3:$type='管内活动';break;
        case 4:$type='管内课程';break;
        case 5:$type='管内讲座';break;
    }
    return $type;
}
function get_uid(){
    return $_SESSION['user']['userid'];
}
function get_user(){
    $userid=get_uid();
    $user_type=get_user_type();
    if ($user_type==1){
        $user_model=M('users');
    }if ($user_type==2){
        $user_model=M('admin_users');
    }
    $user=$user_model->where("id=$userid")->find();
    return $user;
}
function save_data($id,$table,$data){
    $model=M("$table");
    $result=$model->where("id=$id")->save($data);
    return $result;
}
function get_user_type(){
    return $_SESSION['user']['user_type'];
}
function get_refer_url(){
    return $_SERVER['HTTP_REFERER'];
}
function sp_password($passwd){
    $spasswd = "###" . md5(md5("UewBc27f4YZvbr0e6p" . $passwd));
    return $spasswd;
}
function reduce_sum($id){//库存减1
    $result=M('details')->where("id=$id")->setDec("book_num");
    return $result;
}
function add_sum($id){//库存加1
    $result=M('details')->where("id=$id")->setInc("book_num");
    return $result;
}
function add_score($id,$corn){//用户积分加
    $result=M('users')->where("id=$id")->setInc("corn",$corn);
    return $result;
}
function reduce_score($id,$corn){//用户积分减
    $result=M('users')->where("id=$id")->setDec("corn",$corn);
    return $result;
}
/**
 * 获取分类列表
 */
function get_terms(){
    $terms=M('terms')->where("status=1")->select();
    return $terms;
}
/**
 * 检测是否登录
 * @return boolean 是否登录
 */
function check_login(){
    if (!empty($_SESSION['user']['userid'])){
        return true;
    }else{
        return false;
    }
}

/**
 * 字符串截取，支持中文和其他编码
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $suffix 截断显示字符
 * @param string $charset 编码格式
 * @return string
 */
function re_substr($str, $start=0, $length, $suffix=true, $charset="utf-8") {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']  = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    $omit=mb_strlen($str) >=$length ? '...' : '';
    return $suffix ? $slice.$omit : $slice;
}

// 设置验证码
function show_verify($config=''){
    if($config==''){
        $config=array(
            'codeSet'=>'1234567890',
            'fontSize'=>30,
            'useCurve'=>false,
            'imageH'=>60,
            'imageW'=>240,
            'length'=>4,
            'fontttf'=>'4.ttf',
            );
    }
    $verify=new \Think\Verify($config);
    return $verify->entry();
}

// 检测验证码
function check_verify($code){
    $verify=new \Think\Verify();
    return $verify->check($code);
}


/**
 * 获取一定范围内的随机数字
 * 跟rand()函数的区别是 位数不足补零 例如
 * rand(1,9999)可能会得到 465
 * rand_number(1,9999)可能会得到 0465  保证是4位的
 * @param integer $min 最小值
 * @param integer $max 最大值
 * @return string
 */
function rand_number ($min=1, $max=9999) {
    return sprintf("%0".strlen($max)."d", mt_rand($min,$max));
}

/**
 * 生成一定数量的随机数，并且不重复
 * @param integer $number 数量
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @return string
 */
function build_count_rand ($number,$length=4,$mode=1) {
    if($mode==1 && $length<strlen($number) ) {
        //不足以生成一定数量的不重复数字
        return false;
    }
    $rand   =  array();
    for($i=0; $i<$number; $i++) {
        $rand[] = rand_string($length,$mode);
    }
    $unqiue = array_unique($rand);
    if(count($unqiue)==count($rand)) {
        return $rand;
    }
    $count   = count($rand)-count($unqiue);
    for($i=0; $i<$count*3; $i++) {
        $rand[] = rand_string($length,$mode);
    }
    $rand = array_slice(array_unique ($rand),0,$number);
    return $rand;
}

/**
 * 生成不重复的随机数
 * @param  int $start  需要生成的数字开始范围
 * @param  int $end 结束范围
 * @param  int $length 需要生成的随机数个数
 * @return array       生成的随机数
 */
function get_rand_number($start=1,$end=10,$length=4){
    $connt=0;
    $temp=array();
    while($connt<$length){
        $temp[]=rand($start,$end);
        $data=array_unique($temp);
        $connt=count($data);
    }
    sort($data);
    return $data;
}

/**
 * 传入时间戳,计算距离现在的时间
 * @param  number $time 时间戳
 * @return string       返回多少以前
 */
function word_time($time) {
    $time = (int) substr($time, 0, 10);
    $int = time() - $time;
    $str = '';
    if ($int <= 2){
        $str = sprintf('刚刚', $int);
    }elseif ($int < 60){
        $str = sprintf('%d秒前', $int);
    }elseif ($int < 3600){
        $str = sprintf('%d分钟前', floor($int / 60));
    }elseif ($int < 86400){
        $str = sprintf('%d小时前', floor($int / 3600));
    }else{
        $str = date('Y-m-d H:i:s', $time);
    }
    return $str;
}


/**
 * 生成二维码
 * @param  string  $url  url连接
 * @param  integer $size 尺寸 纯数字
 */
function qrcode($url,$size=4){
    Vendor('Phpqrcode.phpqrcode');

//    $path = "images1/";
    // 生成的文件名
//    $fileName = $path.$size.'.png';
    ob_start();
    QRcode::png($url,false,QR_ECLEVEL_L,$size,2,false,0xFFFFFF,0x000000);
    $imageString = base64_encode(ob_get_contents());
    ob_end_clean();
//    <img src="data:image/png;base64,这里是base64编码内容" />
    return $imageString;
}
// 取Book信息
function get_book_data($isbn) {
    $appkey="c497a86c8427466bf5412afb0ee477ed";
    vendor("Book.book");
    $params=array('sub'=>$isbn,'key'=>$appkey);
    $paramsstring=http_build_query($params);
    $url = "http://feedback.api.juhe.cn/ISBN";//聚合数据接口
//    $url = "http://api.douban.com/v2/book/isbn/".$isbn; 豆瓣接口
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$url.'?'.$paramsstring);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    $book_array = (array) json_decode($result, true);
    if(!empty($book_array["result"]["title"])) {
        $book_title = $book_array["result"]["title"];
        $book_author = $book_array["result"]["author"];
        $book_cover = $book_array["result"]["images_medium"];
        $book_isbn = $book_array["result"]["isbn13"]; // ISBN13
        $book_info = $book_array["result"]["summary"];
        $book_publisher=$book_array["result"]["publisher"];
        $book_price=$book_array["result"]["price"];
        $book_pubdate=$book_array["result"]["pubdate"];
        $book = new \Book($book_title, $book_isbn, $book_author, $book_cover, $book_info,$book_publisher,$book_price,$book_pubdate);
    }
    return $book;
}

