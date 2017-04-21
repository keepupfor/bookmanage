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
        $url=get_refer_url();
        if($url){
            $this->assign('url',$url);
        }
        if (isset($_POST["t_mobile"])) {
            $mobile = I("post.t_mobile");
            $passwd = I("post.t_password");
            $identify = I('post.identify');
            $spasswd = "###" . md5(md5("UewBc27f4YZvbr0e6p" . $passwd));
            $model = new Model();
            if ($identify==1) {//会员登录
                $sql = "select * from bookmanage.book_users where mobile=$mobile and user_pass='$spasswd'";
                $query = $model->query($sql);
                if ($query != null && count($query) == 1) {
                    session("user_type",$query[0]["user_type"]);
                    session("userid", $query[0]["id"]);
                    $where['id'] =$query[0]["id"];
                    $data = array(
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'last_login_ip' => get_client_ip(0,true),
                    );
                    $users_model=new Model('bookmanage.book_users');
                    $rel=$users_model->where($where)->save($data);
                    $this->ajaxReturn(array('status'=>1,'url'=>$url));
                } else {
                    $this->ajaxReturn(array('status'=>0));
                }
            } elseif ($identify==2) {//管理员登陆
                $sql = "select * from bookmanage.book_admin_users where mobile=$mobile and user_pass='$spasswd'";
                $query = $model->query($sql);
                if ($query != null && count($query) == 1) {
                    session("user_type",$query[0]["user_type"]);
                    session("userid", $query[0]["id"]);
                    $where['id'] =$query[0]["id"];
                    $data = array(
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'last_login_ip' => get_client_ip(0,true),
                    );
                    $users_model=new Model('bookmanage.book_users');
                    $users_model->where($where)->save($data);
                    $this->ajaxReturn(array('status'=>1,'url'=>$url));
                } else {
                    $this->ajaxReturn(array('status'=>0));
                    exit;
                }
            }else{
                $this->ajaxReturn(array('status'=>-1));
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
            if($str =='1'){
                $userMdl = M('bookmanage.book_users');
            }else{
                $userMdl = M('bookmanage.book_admin_users');
            }
            $ismobile = $userMdl->where("mobile =$mobile ")->find();
            if ($ismobile) {
                $this->error('手机号已存在！');
            } else {
                if($str ==1){
                    $find=substr($mobile,3,4);
                    $encode_mobile='会员'.str_replace($find,'****',$mobile);
                    $result = $userMdl->add(array(
                        "mobile" =>$mobile,
                        "user_pass" =>"###".md5(md5("UewBc27f4YZvbr0e6p".$user_pass)),
                        "create_time"=>date("Y-m-d H:i:s"),
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'create_ip' => get_client_ip(0,true),
                        'last_login_ip' => get_client_ip(0,true),
                        'user_status' => 1,
                        "user_type"=>1,//1会员，2管理员
                        'user_name'=>$encode_mobile
                    ));
                    if($result&&$mobile){
                        $where['id'] =$result;
                        $data = array(
                            'last_login_time' => date("Y-m-d H:i:s"),
                            'last_login_ip' => get_client_ip(0,true),
                        );
                        $userMdl->where($where)->save($data);
                        session("user_type",1);
                        session("userid", $result);
                       $this->ajaxReturn(array('status'=>1));
                    }
                }else{
                    $find=substr($mobile,3,4);
                    $encode_mobile='管理员'.str_replace($find,'****',$mobile);
                    $result = $userMdl->add(array(
                        "mobile" =>array(
                            'exp',
                            "ENCODE('" . $mobile . "', '1!q2@w')"),
                        "user_pass" =>"###".md5(md5("UewBc27f4YZvbr0e6p".$user_pass)),
                        "create_time"=>date("Y-m-d H:i:s"),
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'create_ip' => get_client_ip(0,true),
                        'last_login_ip' => get_client_ip(0,true),
                        'user_status' => 1,
                        "user_type"=>2,//1会员，2管理员
                        'user_name'=>$encode_mobile
                    ));
                    if($result&&$mobile){
                        $where['id'] =$result;
                        $data = array(
                            'last_login_time' => date("Y-m-d H:i:s"),
                            'last_login_ip' => get_client_ip(0,true),
                        );
                        $userMdl->where($where)->save($data);
                        session("user_type",2);
                        session("nickname", '匿名');
                        session("userid", $result);
                        $this->ajaxReturn(array('status'=>1));
                    }
                }
            }
        }
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
                $userMdl = M('bookmanage.book_users');
            } elseif ($identify == 'teacher') {
                $userMdl = M('bookmanage.book_users');
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