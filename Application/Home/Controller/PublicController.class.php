<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/16
 * Time: 11:16
 */

namespace Home\Controller;

use Think\Controller;
use Think\Model;

class PublicController extends Controller
{
//    登陆
    public function login()
    {
        $username = I("post.username");
        $passwd = I("post.password");
        if ($username=='admin' && $passwd=='123456'){
            $user=array('userid'=>1,'user_type'=>2);
            session("user",$user);
            $this->ajaxReturn(array("status"=>1,"info"=>'登陆成功'));
    }else{
            $this->ajaxReturn(array("status"=>0,"info"=>'账号或密码错误！'));
        }
        $url=get_refer_url();
        if($url){
            $this->assign('url',$url);
        }
        if (isset($_POST["t_mobile"])) {
            $mobile = I("post.t_mobile");
            $passwd = I("post.t_password");
            $chk_isremember = I("post.chk_isremember");
            $identify = I('post.identify');
            if (!checkMobile($mobile)) {
                echo "<script>alert('请输入正确的手机号码');window.history.go(-1);</script>";
                exit;
            } else if ($passwd == "") {
                echo "<script>alert('请输入密码');window.history.go(-1);</script>";
                exit;
            }
            $spasswd = "###" . md5(md5("UewBc27f4YZvbr0e6p" . $passwd));
            $model = new Model();
            if ($identify=="student") {
                $sql = "select * from 365class.class_student_users where mobile=ENCODE('$mobile','1!q2@w') and user_pass='$spasswd'";
                $query = $model->query($sql);
                if ($query != null && count($query) == 1) {
                    $nickname = $query[0]["user_nicename"];
                    $realname =$query[0]['user_realname'];
                    session("user_type",$query[0]["user_type"]);
                    session("nickname", $nickname);
                    session('realname',$realname);
                    session("userid", $query[0]["id"]);
                    //记录cookie
                    $salt = $this->random_str(16);
                    //第二分身标识
                    $identifier = md5($salt . md5($query[0]['id'] . $salt));
                    //永久登录标识
                    $token = md5(uniqid($spasswd, true));
                    //永久登录超时时间(1周)
                    $timeout = time()+3600*24*7;
                    setcookie('_auth',$identifier.':'.$token,$timeout,"/");
                    $login_data = array(
                        'login_id' => $query[0]['id'],
                        'login_type' => $query[0]['user_type'],
                        'login_ip' => get_client_ip(0,true),
                        'login_time' => date("Y-m-d H:i:s"),
                        'login_token' => $token
                    );
                    $r=M('365class.class_login_log')->add($login_data);
                    $where['id'] =$query[0]["id"];
                    $data = array(
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'last_login_ip' => get_client_ip(0,true),
                        'identifier' =>$identifier,
                        'token'=>$token,
                        'timeout'=>$timeout
                    );
                    $users_model=new Model('365class.class_student_users');
                    $users_model->where($where)->save($data);
                    $user_info=$users_model->where($where)->field('user_realname,school_name,class')->find();
                    $complete=false; //学生信息是否完善标识
                    foreach($user_info as $v){
                        if($v==null){$complete=true;}
                    }
                    if (isset($_POST["chk_isremember"])) {
                        setcookie("loginid", $mobile, time() + 864000);//set 10d
                        cookie('_mobile',$mobile);//用于校内学生判断；
                        setcookie("password", $passwd, time() + 864000);
                        setcookie("isremember", "1", time() + 864000);
                        if($complete){
                            $personalset=U('Student/personalset');
                            echo "<script>if(confirm('您的个人信息尚未完善，是否现在完善？')){location.href='$personalset';}</script>";
                            echo "<script>window.history.go(-2);</script>";
                            die;
                        }
                        if($url){
                            echo "<script>alert('登录成功!');location.href='$url';</script>";
                        }
                        echo "<script>alert('登录成功!');window.history.go(-2);</script>";
                    } else {
                        setcookie("loginid", "", time() - 3600);//clean
                        cookie('_mobile',$mobile);//用于校内学生判断；
                        setcookie("password", "", time() - 3600);
                        setcookie("isremember", "", time() - 3600);
                        if($complete){
                            $personalset=U('Student/personalset');
                            echo "<script>if(confirm('您的个人信息尚未完善，是否现在完善？')){location.href='$personalset';}</script>";
                            echo "<script>window.history.go(-2);</script>";
                            die;
                        }
                        if($url){
                            echo "<script>alert('登录成功!');location.href='$url';</script>";
                        }
                        echo "<script>alert('登录成功!');window.history.go(-2);</script>";
                    }
                } else {
                    echo "<script>alert('手机号码或密码错误!');window.history.go(-1);</script>";
                    exit;
                }
            } elseif ($identify=="teacher") {
                $sql = "select * from 365class.class_teacher_users where mobile=ENCODE('$mobile','1!q2@w') and user_pass='$spasswd'";
                $query = $model->query($sql);
                if ($query != null && count($query) == 1) {
                    $nickname = $query[0]["user_nicename"];
                    $realname = $query[0]["usesr_realname"];
                    session("user_type",$query[0]["user_type"]);
                    session("nickname", $nickname);
                    session("realname",$realname);
                    session("userid", $query[0]["id"]);
                    //记录cookie
                    $salt = $this->random_str(16);
                    //第二分身标识
                    $identifier = md5($salt . md5($query[0]['id'] . $salt));
                    //永久登录标识
                    $token = md5(uniqid($passwd, true));
                    //永久登录超时时间(1周)
                    $timeout = time()+3600*24*7;
                    setcookie('_auth',$identifier.':'.$token,$timeout,"/");
                    $login_data = array(
                        'login_id' => $query[0]['id'],
                        'login_type' => $query[0]['user_type'],
                        'login_ip' => get_client_ip(0,true),
                        'login_time' => date("Y-m-d H:i:s"),
                        'login_token' => $token
                    );
                    $r=M('365class.class_login_log')->add($login_data);
                    $where['id'] =$query[0]["id"];
                    $data = array(
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'last_login_ip' => get_client_ip(0,true),
                        'identifier' =>$identifier,
                        'token'=>$token,
                        'timeout'=>$timeout,
                    );
                    $users_model=new Model('365class.class_teacher_users');
                    $users_model->where($where)->save($data);
                    if (isset($_POST["chk_isremember"])) {
                        setcookie("loginid", $mobile, time() + 864000);//set 10d
                        setcookie("password", $passwd, time() + 864000);
                        setcookie("isremember", "1", time() + 864000);
                        echo "<script>alert('登录成功!');window.history.go(-2);</script>";
                    } else {
                        setcookie("loginid", "", time() - 3600);//clean
                        setcookie("password", "", time() - 3600);
                        setcookie("isremember", "", time() - 3600);
                        echo "<script>alert('登录成功!');window.history.go(-2);</script>";
                    }
                } else {
                    echo "<script>alert('手机号码或密码错误！');window.history.go(-1);</script>";
                    exit;
                }
            }else{
                echo "<script>alert('请选择身份');window.history.go(-1);</script>";
                exit;
            }
        }
        $this->display('login');
    }
    public function logout(){
        session_destroy();
        $this->redirect("Index/index");
    }
    public function register(){
        if($_POST){
            $mobile = I("post.t_mobile");
            $user_pass = I("post.t_password");
            $str = I("post.identify");
            $u_name = I("post.s_name");
            $u_class = I("post.s_class");
            if($str =='student'){
                $userMdl = M('365class.class_student_users');
            }else{
                $userMdl = M('365class.class_teacher_users');
            }
            if (!sp_check_mobile_verify_code($_POST['mobile_verify'])) {
                $this->error("手机验证码错误！");
            }
            $ismobile = $userMdl->where("mobile = ENCODE('" .$mobile  . "', '1!q2@w')")->find();
            if ($ismobile) {
                $this->error('手机号已存在！');
            } else {
                if($str =='student'){
                    $areacode=I('post.country');
                    $school=I('post.school');
                    if(is_numeric($school)){
                        $school=M('class_school_users')->where("id='$school'")->getField('school_name');
                    }
                    $find=substr($mobile,3,4);
                    $encode_mobile='用户'.str_replace($find,'****',$mobile);
                    $u_class = I('post.grade') . "-" . I('post.g_class') . "-" . I('post.s_class');
                    $result = $userMdl->add(array(
                        "mobile" =>array(
                            'exp',
                            "ENCODE('" . $mobile . "', '1!q2@w')"),
                        "user_pass" =>"###".md5(md5("UewBc27f4YZvbr0e6p".$user_pass)),
                        'user_realname'=>$u_name,
                        'class'=>$u_class,
                        "create_time"=>date("Y-m-d H:i:s"),
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'create_ip' => get_client_ip(0,true),
                        'last_login_ip' => get_client_ip(0,true),
                        'user_status' => 1,
                        "user_type"=>1,//1学生，2老师 ，3学校，4机构
                        'areacode'=>$areacode,
                        'school_name'=>$school,
                        'user_nicename'=>$encode_mobile
                    ));
                    if($result&&$mobile){
                        //记录cookie
                        $salt = $this->random_str(16);
                        //第二分身标识
                        $identifier = md5($salt . md5($result . $salt));
                        //永久登录标识
                        $token = md5(uniqid($user_pass, true));
                        //永久登录超时时间(1周)
                        $timeout = time()+3600*24*7;
                        setcookie('_auth',$identifier.':'.$token,$timeout,"/");
                        $where['id'] =$result;
                        $data = array(
                            'last_login_time' => date("Y-m-d H:i:s"),
                            'last_login_ip' => get_client_ip(0,true),
                            'identifier' =>$identifier,
                            'token'=>$token,
                            'timeout'=>$timeout,
                        );
                        $userMdl->where($where)->save($data);
                        session("user_type",1);
                        session("nickname", '匿名');
                        session("realname",$u_name);
                        session("userid", $result);
                        cookie('_mobile',$mobile);
                        $this->show("<script>alert('注册成功');location.href='{:U(\'Index/index\')}';</script>");
                    }
                }else{
                    $areacode=I('post.country');
                    $school=I('post.school');
                    if(is_numeric($school)){
                        $school=M('class_school_users')->where("id='$school'")->getField('school_name');
                    }
                    $result = $userMdl->add(array(
                        "mobile" =>array(
                            'exp',
                            "ENCODE('" . $mobile . "', '1!q2@w')"),
                        "user_pass" =>"###".md5(md5("UewBc27f4YZvbr0e6p".$user_pass)),
                        "create_time"=>date("Y-m-d H:i:s"),
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'create_ip' => get_client_ip(0,true),
			'user_realname'=>$u_name,
                        'last_login_ip' => get_client_ip(0,true),
                        'user_status' => 1,
                        "user_type"=>2,//1学生，2老师 ，3学校，4机构
                        'areacode'=>$areacode,
                        'school_name'=>$school
                    ));
                    if($result&&$mobile){
                        //记录cookie
                        $salt = $this->random_str(16);
                        //第二分身标识
                        $identifier = md5($salt . md5($result . $salt));
                        //永久登录标识
                        $token = md5(uniqid($user_pass, true));
                        //永久登录超时时间(1周)
                        $timeout = time()+3600*24*7;
                        setcookie('_auth',$identifier.':'.$token,$timeout,"/");
                        $where['id'] =$result;
                        $data = array(
                            'last_login_time' => date("Y-m-d H:i:s"),
                            'last_login_ip' => get_client_ip(0,true),
                            'identifier' =>$identifier,
                            'token'=>$token,
                            'timeout'=>$timeout,
                        );
                        $userMdl->where($where)->save($data);
                        session("user_type",2);
                        session("nickname", '匿名');
                        session("realname",$u_name);
                        session("userid", $result);
                        cookie('_mobile',$mobile);
                        $this->show("<script>alert('注册成功');location.href='{:U(\'Index/index\')}';</script>");
                    }
                }
            }
        }
        $province_list=M('class_region')->where("level_id = 0")->select();
        $city_list=M('class_region')->where("father_id=36")->select();
        $country_list=M('class_region')->where("father_id=3601")->select();
        $this->assign('province_list',$province_list);
        $this->assign('city_list',$city_list);
        $this->assign('country_list',$country_list);
        $this->display();
    }
    //忘记密码
    public function forget(){
        if($_POST){
            $mobile=I('post.t_mobile');
            $identify=I('post.identify');
            if(!sp_check_mobile_verify_code(I('post.mobile_verify'))){
                $this->error('手机验证码错误');
            }
            $this->assign('mobile',$mobile);
            $this->assign('identify',$identify);
            $this->display('reset');//加载修改密码页面
            return;
        }
        $this->display();
    }
    public function reset(){
        if($_POST) {
            $password = I('post.password');
            $mobile = I('post.mobile');
            $identify = I('post.identify');
            if ($identify == 'student') {
                $userMdl = M('365class.class_student_users');
            } elseif ($identify == 'teacher') {
                $userMdl = M('365class.class_teacher_users');
            }
            $data = array();
            $data['user_pass'] = "###" . md5(md5("UewBc27f4YZvbr0e6p" . $password));
            if(!($userMdl->where("mobile=ENCODE('".$mobile."','1!q2@w')")->find())){
                $this->ajaxReturn(2);
            }
            $result = $userMdl->where("mobile=ENCODE('$mobile','1!q2@w')")->save($data);
            //修改成功返回受影响行数，失败返回false
            if ($result) {
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(0);
            }
        }
    }
//    检测用户是否登陆并返回用户信息
    public function is_login(){
        if(check_login()){
            $user_info = array('userid'=>get_uid(),'user_type'=>get_user_type());
            $this->ajaxReturn(array("status"=>1,"user"=>$user_info));
        }else{
            $this->ajaxReturn(array("status"=>0,"info"=>"此用户未登录！"));
        }
    }
}