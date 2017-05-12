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
        $url = $_GET['url'];
        if (isset($_POST["t_mobile"])) {
            $mobile = I("post.t_mobile");
            $passwd = I("post.t_password");
            $identify = I('post.identify');
            $spasswd = "###" . md5(md5("UewBc27f4YZvbr0e6p" . $passwd));
            $model = new Model();
            if ($identify == 1) {//会员登录
                $sql = "select * from bdm28103326_db.book_users where mobile=$mobile and user_pass='$spasswd'";
                $query = $model->query($sql);
                if ($query != null && count($query) == 1) {
                    if ($query[0]["user_status"]==0){
                        $this->ajaxReturn(array('status' => -1));die;
                    }else{
                        $user = array("user_type" => $query[0]["user_type"], "userid" => $query[0]["id"]);
                        session("user", $user);
                        $where['id'] = $query[0]["id"];
                        $data = array(
                            'last_login_time' => date("Y-m-d H:i:s"),
                            'last_login_ip' => get_client_ip(0, true),
                        );
                        $users_model = M('users');
                        $rel = $users_model->where($where)->save($data);
                        $this->ajaxReturn(array('status' => 1, 'url' => $url));
                    }
                } else {
                    $this->ajaxReturn(array('status' => 0));
                }
            } elseif ($identify == 2) {//管理员登陆
                $sql = "select * from bdm28103326_db.book_admin_users where mobile=$mobile and user_pass='$spasswd'";
                $query = $model->query($sql);
                if ($query != null && count($query) == 1) {
                    $user = array("user_type" => $query[0]["user_type"], "userid" => $query[0]["id"]);
                    session("user", $user);
                    $where['id'] = $query[0]["id"];
                    $data = array(
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'last_login_ip' => get_client_ip(0, true),
                    );
                    $users_model = M('admin_users');
                    $users_model->where($where)->save($data);
                    $this->ajaxReturn(array('status' => 1, 'url' => $url));
                } else {
                    $this->ajaxReturn(array('status' => 0));
                    exit;
                }
            } else {
                $this->ajaxReturn(array('status' => -1));
                exit;
            }
        }
        $this->display('login');
    }

    public function logout()
    {
        session_destroy();
        $this->redirect("Index/index");
    }

    public function register()
    {
        if ($_POST) {
            $mobile = I("post.t_mobile");
            $user_pass = I("post.t_password")? I("post.t_password"):123456;
            $str = I("post.identify")? I("post.identify"):1;
            $user_name=I("post.username");
            if ($str == 1) {
                $userMdl = M('users');
            } else {
                $userMdl = M('admin_users');
            }
            $ismobile = $userMdl->where("mobile=$mobile")->find();
            if ($ismobile) {
                $this->error('手机号已存在！');
            } else {
                if ($str == 1) {
                    $find = substr($mobile, 3, 4);
                    $encode_mobile = '会员' . str_replace($find, '****', $mobile);
                    $result = $userMdl->add(array(
                        "mobile" => $mobile,
                        "user_pass" => "###" . md5(md5("UewBc27f4YZvbr0e6p" . $user_pass)),
                        "addtime" => date("Y-m-d H:i:s"),
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'create_ip' => get_client_ip(0, true),
                        'last_login_ip' => get_client_ip(0, true),
                        "user_type" => 1,//1会员，2管理员
                        'user_name' => $user_name?$user_name:$encode_mobile,
                        'user_secret'=>123456
                    ));
                    if ($result && $mobile) {
                        $where['id'] = $result;
                        $data = array(
                            'last_login_time' => date("Y-m-d H:i:s"),
                            'last_login_ip' => get_client_ip(0, true),
                        );
                        $userMdl->where($where)->save($data);
                        $user = array("user_type" => 1, "userid" => $result);
                        if (empty($user_name))session("user", $user);
                        $this->ajaxReturn(array('status' => 1));
                    } else {
                        $this->ajaxReturn(array('status' => 0));
                    }
                } else {
                    $find = substr($mobile, 3, 4);
                    $encode_mobile = '管理员' . str_replace($find, '****', $mobile);
                    $result = $userMdl->add(array(
                        "mobile" => $mobile,
                        "user_pass" => "###" . md5(md5("UewBc27f4YZvbr0e6p" . $user_pass)),
                        "create_time" => date("Y-m-d H:i:s"),
                        'last_login_time' => date("Y-m-d H:i:s"),
                        'create_ip' => get_client_ip(0, true),
                        'last_login_ip' => get_client_ip(0, true),
                        "user_type" => 2,//1会员，2管理员
                        'user_name' => $encode_mobile,
                        'user_secret'=>123456
                    ));
                    if ($result && $mobile) {
                        $where['id'] = $result;
                        $data = array(
                            'last_login_time' => date("Y-m-d H:i:s"),
                            'last_login_ip' => get_client_ip(0, true),
                        );
                        $userMdl->where($where)->save($data);
                        $user = array("user_type" => 2, "userid" => $result);
                        session("user", $user);
                        $this->ajaxReturn(array('status' => 1));
                    } else {
                        $this->ajaxReturn(array('status' => 0));
                    }
                }
            }
        }
        $this->display();
    }

    //忘记密码
    public function forget()
    {
        if ($_POST) {
            $mobile = I('post.mobile');
            $user_secret=I('post.user_secret');
            $user_type = I('post.user_type');
            if ($user_type == '1') {
                $userMdl = M('users');
            } elseif ($user_type == '2') {
                $userMdl = M('admin_users');
            }
            $is_find=$userMdl->where("mobile=$mobile")->find();
            if ($is_find){
                if ($user_secret==$is_find['user_secret']){
                    $this->ajaxReturn(array('status'=>1,'mobile'=>$mobile,'user_type'=>$user_type));
                }
                else{
                    $this->ajaxReturn(array('status'=>0,'info'=>'安全码错误'));
                }
            }else{
                $this->ajaxReturn(array('status'=>0,'info'=>'手机号错误'));
            }


        }
        $this->display();
    }

    public function reset()
    {

        if ($_POST) {
            $password = I('post.password');
            $mobile = I('post.mobile');
            $user_type = I('post.user_type');
            if ($user_type == '1') {
                $userMdl = M('users');
            } elseif ($user_type == '2') {
                $userMdl = M('admin_users');
            }
            $data = array();
            $data['user_pass'] = "###" . md5(md5("UewBc27f4YZvbr0e6p" . $password));
            $result = $userMdl->where("mobile=$mobile")->save($data);
            //修改成功返回受影响行数，失败返回false
            if ($result) {
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(0);
            }
        }else{
            $mobile=I("mobile");
            $user_type=I("user_type");
            $this->assign('mobile', $mobile);
            $this->assign('user_type', $user_type);
            $this->display('reset');//加载修改密码页面
        }
    }

//    检测用户是否登陆并返回用户信息
    public function is_login()
    {
        if (check_login()) {
            $user_info = array('userid' => get_uid(), 'user_type' => get_user_type());
            $this->ajaxReturn(array("status" => 1, "user" => $user_info));
        } else {
            $this->ajaxReturn(array("status" => 0, "info" => "此用户未登录！"));
        }
    }

//    ajax请求处理
    public function ajax_request()
    {
        if($_FILES) {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array(
                'jpg',
                'png',
                'gif',
                'jpeg'
            );
            $upload->autoSub = false;
            $upload->rootPath = './Public/';
            $upload->savePath = '/upload/';
            $info = $upload->upload();
            $_POST['img'] = __ROOT__.'/Public'.$info['img']['savepath'].$info['img']['savename'];
        }
        $table_name = $_POST['table_name'];
        $id = $_POST['id'];
        $method=$_POST['method'];
        unset($_POST['table_name']);
        unset($_POST['id']);
        unset($_POST['method']);
        if ($method=="save"){
            $result = save_data($id, $table_name, $_POST);
        }
         if ($method=="add"){
             $_POST['addtime']=date('Y-m-d H:i:s');
             $result=M($table_name)->add($_POST);
//             dump(M($table_name)->getLastSql());die;
         }
        if ($method=="delete"){
            $result=M($table_name)->where("id=$id")->delete();
        }
        if ($result === false) {
            $this->ajaxReturn(array('status' => 0));
        } else {
            $this->ajaxReturn(array('status' => 1));
        }
    }
}